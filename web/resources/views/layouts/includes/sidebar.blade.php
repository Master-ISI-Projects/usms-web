<div class="menu">
    <div class="main-menu">
        <div class="scroll">
            <ul class="list-unstyled">
                <li {!! Helper::routeIs('admin.dashboard') ? 'class="active"' : '' !!}>
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="iconsminds-shop-4"></i>
                        <span>Tableau de bord</span>
                    </a>
                </li>
                <li {!! Helper::routeIs('teachers.index') ? 'class="active"' : '' !!}>
                    <a href="{{ route('teachers.index') }}">
                        <i class="iconsminds-business-man-woman"></i> Ensignants
                    </a>
                </li>
                <li {!! Helper::routeIs('students.index') ? 'class="active"' : '' !!}>
                    <a href="{{ route('students.index') }}">
                        <i class="iconsminds-student-male-female"></i> Etudiants
                    </a>
                </li>
                <li {!! Helper::routeIs('departements.index') ? 'class="active"' : '' !!}>
                    <a href="{{ route('departements.index') }}">
                        <i class="iconsminds-museum"></i> Departements
                    </a>
                </li>
                <li {!! Helper::routeIs('classes.index') ? 'class="active"' : '' !!}>
                    <a href="{{ route('classes.index') }}">
                        <i class="simple-icon-grid"></i> Classes
                    </a>
                </li>
                <li>
                    <a href="mobile-settings">
                        <i class="iconsminds-smartphone-3"></i> Application Mobile
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="sub-menu">
        <div class="scroll">
            <ul class="list-unstyled" data-link="mobile-settings">
                <li>
                    <a href="{{ route('news.index') }}">
                        <i class="iconsminds-newspaper"></i>
                        <span class="d-inline-block">Actualités</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('events.index') }}">
                        <i class="simple-icon-event"></i>
                        <span class="d-inline-block">Evénements</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('settings.index') }}">
                        <i class="simple-icon-settings"></i> <span class="d-inline-block">Paramétres</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
