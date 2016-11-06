<ul class="menu list-unstyled">
    @if(Sentry::getUser()->hasAnyAccess(['admin.dashboard']))
    <li class="">
        <a href="{{ route('account') }}" class="/">
            <i class="fa fa-tachometer"></i>
            <span>@lang('form/title.dashboard')</span>
        </a>
    </li>
    @endif
    @if(Sentry::getUser()->hasAnyAccess(['advertisements']))
    <li class="">
        <a href="{{ route('advertisements') }}" class="/">
            <i class="fa fa-fw icon-hung-picture"></i>
            <span>@lang('form/title.events')</span>
        </a>
    </li>
    @endif
    @if(Sentry::getUser()->hasAnyAccess(['ideas']))
    <li class="hasSubmenu">
        <a data-toggle="collapse" href="#menu-idea-manager">
            <i class="fa fa-bolt"></i>
            <span>@lang('form/title.ideamanager')</span>
        </a>
        <ul id="menu-idea-manager" class="collapse">
            @if(Sentry::getUser()->hasAnyAccess(['idea.new']))
            <li class="">
                <a class="" href="{{ route('create/idea') }}">
                    <i class="fa fa-plus"></i>
                    <span>@lang('form/title.newidea')</span>
                </a>
            </li>
            @endif
            @if(Sentry::getUser()->hasAnyAccess(['idea.sorting']))
            <li class="">
                <a class="" href="{{ route('unsortedlist/idea') }}">
                    <i class="fa fa-list"></i>
                    <span>@lang('form/title.listunsortedideas')</span>
                </a>
            </li>
            @endif
            @if(Sentry::getUser()->hasAnyAccess(['idea.selected_list']))
            <li class="">
                <a class="" href="{{ route('ideas') }}">
                    <i class="fa fa-list-ol"></i>
                    <span>@lang('form/title.listsortedidea')</span>
                </a>
            </li>
            @endif
            @if(Sentry::getUser()->hasAnyAccess(['idea.complete_list']))
            <li class="">
                <a class="" href="{{ route('completedideas/ideas') }}">
                    <i class="fa fa-check"></i>
                    <span>@lang('form/title.completed_ideas')</span>
                </a>
            </li>
            @endif
            @if(Sentry::getUser()->hasAnyAccess(['idea.exited_list']))
            <li class="">
                <a class="" href="{{ route('exitedideas') }}">
                    <i class="fa fa-times"></i>
                    <span>@lang('form/title.exitedidealist')</span>
                </a>
            </li>
            @endif
        </ul>
    </li>
    @endif

    @if(Sentry::getUser()->hasAnyAccess(['posts']))
    <li class="">
        <a href="{{ route('posts') }}" class="">
            <i class="fa fa-keyboard-o"></i>
            <span>@lang('form/title.posts')</span>
        </a>
    </li>
    @endif

    @if(Sentry::getUser()->hasAnyAccess(['admin']))
    <li class="hasSubmenu">
        <a data-toggle="collapse" href="#menu-Setup">
            <i class="fa fa-cogs"></i>
            <span>@lang('form/title.setup')</span>
        </a>
        <ul id="menu-Setup" class="collapse">
            <li class="">
                <a class="" href="{{ route('workflow_categories') }}">
                    <i class="fa fa-path"></i>
                    <span>@lang('form/title.workflow')</span>
                </a>
            </li>
<!--            <li class="">-->
<!--                <a class="" href="{{ route('activity_forms') }}">-->
<!--                    <i class="fa fa-path"></i>-->
<!--                    <span>@lang('form/title.activityform')</span>-->
<!--                </a>-->
<!--            </li>-->
<!--            <li class="">-->
<!--                <a class="" href="{{ route('form_lookups') }}">-->
<!--                    <i class="fa fa-map"></i>-->
<!--                    <span>@lang('form/title.formfield')</span>-->
<!--                </a>-->
<!--            </li>-->
<!--            <li class="">-->
<!--                <a class="" href="{{ route('form_lookup_data') }}">-->
<!--                    <i class="fa fa-map"></i>-->
<!--                    <span>@lang('form/title.formfieldata')</span>-->
<!--                </a>-->
<!--            </li>-->
            <li class="">
                <a class="" href="{{ route('sectors') }}">
                    <i class="fa fa-map"></i>
                    <span>@lang('form/title.sectors')</span>
                </a>
            </li>
            <li class="">
                <a class="" href="{{ route('pages') }}">
                    <i class="fa fa-map"></i>
                    <span>@lang('form/title.page')</span>
                </a>
            </li>
            <li class="">
                <a class="" href="{{ route('front_banners') }}">
                    <i class="fa fa-map"></i>
                    <span>@lang('form/title.front_banners')</span>
                </a>
            </li>
            <li class="">
                <a class="" href="{{ route('quick_links') }}">
                    <i class="fa fa-map"></i>
                    <span>@lang('form/title.quick_link')</span>
                </a>
            </li>
        </ul>
    </li>
    @endif

    @if(Sentry::getUser()->hasAnyAccess(['users']))
    <li class="hasSubmenu">
        <a data-toggle="collapse" href="#menu-User-Manager">
            <i class="fa fa-users"></i>
            <span>@lang('form/title.usermanager')</span>
        </a>
        <ul id="menu-User-Manager" class="collapse">
            <li class="">
                <a class="" href="{{ route('create/user') }}">
                    <i class="fa fa-user"></i>
                    <span>@lang('form/title.new_user')</span>
                </a>
            </li>
            <li class="">
                <a class="" href="{{ route('users') }}">
                    <i class="fa fa-user"></i>
                    <span>@lang('form/title.user')</span>
                </a>
            </li>
            <li class="">
                <a class="" href="{{ route('groups') }}">
                    <i class="fa fa-lock"></i>
                    <span>@lang('form/title.role')</span>
                </a>
            </li>
        </ul>
    </li>
    @endif
    @if(Sentry::getUser()->hasAnyAccess(['sys_config']))
    <li class="hasSubmenu">
        <a data-toggle="collapse" class="glyphicons settings" href="#menu-frontpage-Manager">
            <i></i>
            <span>@lang('form/title.front_page_setup')</span>
        </a>
        <ul id="menu-frontpage-Manager" class="collapse">
            <li class="">
                <a class="" href="{{ route('priority_list/advertisements') }}">
                    <i class="fa fa-user"></i>
                    <span>@lang('form/title.events')</span>
                </a>
            </li>
            <li class="">
                <a class="" href="{{ route('priority_list/posts') }}">
                    <i class="fa fa-lock"></i>
                    <span>@lang('form/title.posts')</span>
                </a>
            </li>
            <li class="">
                <a class="" href="{{ route('completed_list/ideas') }}">
                    <i class="fa fa-lock"></i>
                    <span>@lang('form/title.completed_ideas')</span>
                </a>
            </li>
            <li class="">
                <a class="" href="{{ route('upcoming_list/ideas') }}">
                    <i class="fa fa-lock"></i>
                    <span>@lang('form/title.upcoming_ideas')</span>
                </a>
            </li>
        </ul>
    </li>
    @endif
</ul>