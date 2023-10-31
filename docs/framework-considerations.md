# Why framework considerations?

We strive for a clear separation of concerns, so we have taken some considerations or made some changes or rules,
on specific areas of the framework.

The goal is, to ensure, that everything stays extensible, flexible, or both, that there is a clear understanding
where something can be found, to avoid bad practices or even promote those supported by some changes, and much more.
Also importantly, everything should be performant by default and not slow down under heavy bulk processing either.

These things will be especially useful, as the system grows over time and more code and areas are added, as also when
it's used on large setups.

## General

### Think "Tell, don't ask principle"

We should try to apply the "Tell, don't ask principle" in many locations of the project. It not only makes the code more
readable and better to handle, but also, it creates unintentionally better structured and re-usable code (not always,
not necessarily, but often).

Also, allows for code structured in ways, which may be easier overridden in other places,
as it may lead in some places more to code which feels like configuring, than hard-coding logic.

Additionally, it may also allow for further decoupling of things (ie. guarding code or authorization) from the rest
of the application code, and placing such in more central places. Which also would mean less crowded code elsewhere
(ie. in controllers) and less spread-out through the application, which may make things harder to debug or overview.

> Procedural code gets information then makes decisions. Object-oriented code tells objects to do things. — Alec Sharp

### Do not use Facades?

Facades are not an anti-pattern, nor do they introduce the issues of static classes (like global state or testability
issues) as some claim, as they are merely proxies to classes, merely syntactic sugar to service location.
Yet, you can't inspect methods called through facades directly in an IDE, even with it's autocompletion fully working.
So, there's no good reason to not use them based on these considerations.

Still though, looking at the Facades class, it does 3-5 additional method calls, to call one method, whenever the
Facade is called directly (not applaying to subsequent chained calls, which do not use the facade as they are calling
a resolved object's method directly). These additional method calls - depending on context - could up to hundreds if
not even thousands of calls within a request. Now, calls these days are not expensive as to consider each one, but in
the overall view they may add up (especially when processing through thousands of entries). Facade are not and should
not be banned from the app's code altogether, but whenever possible to achieve the same result without a Facade, it
should be considered, as to provide better code understanding, better inspection and improve performance in at least
some cases.

Also, untested yet, but since Facades have to be dynamically resolved at runtime and the compiler has absolutely
no hints which classes are involved, it has to do late binding (and that every time on every facade valled) and cannot
profit from any optimizations or op-caching it could have done during compilation.

With dependency injection, even though it is still resolved dynamically through the IoC, after it is being injected in a
class or method, the compiler can have hints on the property or variable used and may be able to either cache late
binding or profit even from early binding, but https://github.com/php/php-src/pull/6627 may have additional effects on
it. So, the performance may be actually to some extent very well impacted (to a different extent for each PHP version
though, consider when testing) where many calls to a Facade are involved.

At last, [Container events](https://laravel.com/docs/10.x/container#container-events) may hurt performance additionally.
Constructor injection will usually lead to an object resolved once only. Other usages of Facades or custom resolving
may lead to repeated firing of events and affected performance (untested claim, some may be cached?).

Consider keeping or even using facades, where swapping (easily) a class may be important (only reason I can think of -
but then again this can be achieved differently). Try to avoid the initial (more expensive) Facade call in looped code
though. Using facades in controllers may be fine, but then again it should be considered to be avoided everywhere (a
whole "code ban" is easier to follow than partial).


Reads:

* https://daylerees.com/laravel-facades/
* https://programmingarehard.com/2014/01/11/stop-using-facades.html/
* https://phpnews.io/feeditem/response-don-t-use-facades
* https://daylerees.com/laravel-facades/ (Section "Considerations")

## Controllers should be strictly only orchestrators (or the "Tell, don't ask principle" - declarative controllers)

Controllers should be only orchestrators means, that they should only orchestrate code in other places. As that,
they should not contain any logic on their own, but only do any method calls required to get the desired result.
If there is code doing more than that, which seems as business-specific logic it should be considered to be moved
into it's own method outside the controller.

This may not seem in a small project important, but as the project grows and the same may be required over time
at other locations to be called, it starts becoming more of a pain, if such code is located inside controllers. Even,
if at the time it was written it seemed as if only the controller would ever need to call it, as it may be
a job dispatched immediately or something called with a different state.

As that, they should only pass variables around methods and make the necessary calls. Anything more, even conditions,
could be usually candidates to be extracted.

This propagates easier code re-usage and ensures, that all code inside controllers is usually well-tested.

By the way, the same applies also for anything with a similar scope in the project, like job schedulers and handlers,
as well console commands.

Also, consider using https://github.com/imanghafoori1/laravel-terminator or similar solutions (that's how we want
controller code to look like, to be readable and easily understandable).

## Database and Models

Working before with a codebase which was database heavy with a lot of queries, much use of query builder and a
wide selection of eloquent features, and seeing how this project be similar in that matter, the following improvements
for this project come into mind, to make development not only easier, but also database usage easier, as also several
other areas like refactoring, avoiding subtle errors and a lot more which were issues at some point in the previous
project.

### Do not use Model classes widely

Model classes should not be used directly as much as possible. wherever a single row for a model is requested and
needed,
by some very simply query like the ID or an email, it is fine to use the model class directly. In all other cases, it
should be "hidden" behind some classes managing data retrieval and hiding queries (see also next point).

Data retrieval should be done through repositories, which should contain the whole logic of requesting data. The
repositories method names will describe the data requested. This benefits us in many places:

- Complexity in other parts of the code is reduced while it's code becomes more readable.
- Queries become more testable on their own.
- Bugs regarding queries are limited to one location only and as such,
- Bugfixes or refactoring can be applied or done in one location only.

As such, wherever the query builder is needed, it should be always considered to add a method in a repository class
instead and call this one.

Repositories should only be used for data retrieval though, not for saving data, as some make the mistake of
misunderstanding the repository pattern.

### Repositories should be "composers" or "instructors" only

That requires explanation. In a more advanced application, there will be often query clauses which represent some
"state". Sometimes even a group of such query clauses. And these may be needed in many different queries retrieving a
different set of data. This is in many ways similar to what scopes in models achieve. However (see next point), not all
things are good candidates for the model (especially since repositories are focused on bulk data) nor should the model
be bloated with a lot of code. And since we depend on repositories to retrieve more complex data, we do not have to
depend on scopes all the time.

This leads us to the point, that queries can become in some cases quite extensive and things repetitive in many methods.
For the same reasons we utilize Repositories and increasing the readability, we should also increase the readability in
Repository code itself (trust me, I have seen cases, where query builder code can become quite large and complex,
especially when requiring things like sub queries and a lot of conditions). This can be achieved by repositories being
mostly "instructors" and not contain the repetitive query builder code (in the sense of scopes) themselves, but make
use of "query classes", which methods will contain part of the queries with a descriptive name, in the same way as
scopes in models would provide. This is especially useful, since the query builder can be parsed around and extended
by different methods easily.

### Do not use hardcoded column and table names

One thing that always bothered me is, that a lot eloquent requires you to write column names (identifiers) as strings,
starting from migrations to queries, to scopes or relations etc. And table names, even though less often used
directly - unless you may use something like Db::table() - is similar. This can cause several issues:

- Typos may commonly occur occasionally. Only tests or running code may show the mistake!
- Autocompletion may be an issue or may not work without additional modules understanding Eloquent or additional setup.
- Names would be throughout the code, hard to know where and to find them. That will only partially reduce, when using
  the repository pattern, but not eliminated.
- Refactoring (such as renaming columns) in large applications may nearly impossible or at least very hard.
- If 3rd party code - think modules - are supported, it's impossible to ever change names, as their code won't adjust to
  use the new identifiers automatically.
- Some projects end up diverging more and more overtime, by being forced to keep identifiers of database columns named
  with their legacy names instead of changing them to their new names used elsewhere (i.e. product variants
  in a large open source shop are now identified by 4 different names in database, api, code and back office).
- If anything, names like that are similar to constant or magic values, which should not be used directly in code.

For these reasons, this project will introduce a way to use either enums or constants instead of column or tables names.
If a column or table identifier has to be renamed, it has to be renamed in one and only location. This even decouples
3rd party code in such a way from such changes, that it will continue working without having to be updated by
immediately re-using the modified value for the identifier.

Column or table identifiers must not be written in code directly as strings.

## Blade and Views

### Blade Template file extension

We made the change of Blade Template files having the extension the ".blade" vs ".blade.php".
This is to better communicate, that php code must not be used in blade files at any time. If php methods are needed,
then a better way would be to introduce "filters" at some point.

Yet, at the moment the use of .blade.php or of any functionality is not restricted. This may change in a future release
though. Functionality which should not be in template files used, may even be restricted.

### Do not use inline view components

Always prefer [Anonymous View Compnents](https://laravel.com/docs/master/blade#anonymous-components)
over [Inline view components](https://laravel.com/docs/master/blade#inline-component-views).

The reason is, it is still template code and it should reside where other template code resides. This makes it easier to
track it down, to modify it without touching code or do anything else otherwise possible with templates (imagine a
multi-theme package allowing you to override individual template files). Besides, avoiding to have one more class, just
for template code.

## Library Considerations

Libraries which could be considered or maybe even required at some point to be used in the project.

### General libraries

* https://github.com/imanghafoori1/laravel-smart-facades
* https://github.com/imanghafoori1/laravel-widgetize
* https://github.com/imanghafoori1/laravel-heyman
* https://github.com/imanghafoori1/laravel-decorator
* https://github.com/PrinsFrank/php-validated-properties
* https://github.com/lepikhinb/laravel-fluent

### Development libraries

* https://github.com/glhd/laravel-dumper
* https://github.com/imanghafoori1/laravel-microscope
* https://github.com/imanghafoori1/laravel-anypass
* https://github.com/imanghafoori1/eloquent-mockery
* https://www.larabug.com/ and https://github.com/LaraBug/larabug-app
* https://github.com/johnkary/phpunit-speedtrap / https://github.com/hughsaffar/laravel-test-trap
* https://github.com/larawatcher/larawatcher
* Try to not depend on https://github.com/barryvdh/laravel-ide-helper - in the past years, alternative solutions,
  php language features or ways of coding have appeared, which make dependence on this package less

### Libraries not further examined, but may be interesting or useful - list acts merely like a to-check-list

* https://github.com/railken/eloquent-mapper

# Other considerations

See https://github.com/imanghafoori1/laravel-nullable and section "Testing". The specific library is not necessarily
a desired solution for null checks and test coverage or coverage detection, but a solution in "higher places" would be
desirable and improve overall quality of the code, even for 3rd party code providing packages or in future modules to
the project. "findOrFail()" does NOT solve the issue as it throws an error early, ignoring the fact if you have
forgotten to cover the null occurrence.

Consider using https://github.com/imanghafoori1/laravel-heyman or some other self-written approach. Benefit is,
other packages do not directly associate permissions (roles and capabilities or attributes) with models, controller
actions as well even events, routes and views to be rendered. There is an advantage here, to be able to do that in such
a way and create relations like that, and guard or allow them based on several conditions, while keeping it readable
and easy to overview (not spread-out in several places, if something involves a controller, a model and a view).

https://github.com/imanghafoori1/laravel-middlewarize useful?

