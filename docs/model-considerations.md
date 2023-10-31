# Best practices for models and database

These best practices should be followed at all times in Jornada, when working with models and databases.

* Eloquent models should always use fillable, do NOT make them unguarded. Unguarded seems a more simple approach and
  feels as if not having any downsides, however that is not true. There are often fields which are not used in queries
  for mass updating and should not be mass updatable by default, which can cause side effects if someone would
  manipulate them unexpectedly or in ways not anticipated. What if a hacker would change relationships of a model, to
  gain access to many other entries - probably something you are not doing usually in that way and as such having one
  of those "hidden" issues in your code, which seems fine while using unguarded, and neither thinking about that field
  being manipulated in unexpected ways.
* Migrations in Jornada should not have a down() method. These operations are often destructive in nature (dropping a
  column or a table) and may cause irrecoverable data loss, without asking for prior consent and without it being clear
  that this may be the case. Despite, even non-destructive changes may be difficult or impossible to revert (there are
  many such examples) or may involve too much code to do so, which more than often is more likely to be even untested.
  To avoid these issues, like data loss, we are opting to ignore down() methods completely, and instead have better up()
  code which would avoid migrations failing, by having additional checks in the up() method before applying operations,
  like checking that a table or column does not yet exist or failing explicitly by throwing intentionally an exception.
* See https://laravel.com/docs/10.x/eloquent#mass-assignment-exceptions - probably something to be applied in production
  too, as silently ignoring may lead to bugs too difficult to debug, especially since behaviour would differ between
  environments. An exception should be thrown at all times probably, even in production, to also catch errors or even
  possible hacking attempts on the live servers, when otherwise nothing obvious - as it being ignored - may indicate
  an issue. Silently ignoring fields feels like php's "@".
* Never use models directly. Always use Repositories and so-called (jornada-typical) query classes. These allow to make
  operations independent of the actual model structure, which allows for easier refactoring and changes in data
  structures, as anything using these query classes (including 3rd party modules) should not require changes, but only
  the query or repository class itself.
* Provide where applicable a json-column for an arbitrary amount of data to be stored such as metadata for many models.
  Especially imported or external data may profit from such a json column, such when storing media, attachments etc.
  These usually would be not queried, only read, for performance reasons. If any of the data in there needs to be
  queried, it should be either a separate column and not part of the metadata, or adding an indexed virtual column.
