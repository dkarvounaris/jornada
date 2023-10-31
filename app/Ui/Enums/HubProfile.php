<?php

namespace Ui\Enums;

enum HubProfile: string
{
    case _prefix_url = 'profile';
    case _prefix_name = 'hub.profile';
    case Welcome = 'hub.profile.main';
    case Profile = 'hub.profile.profile';
}
