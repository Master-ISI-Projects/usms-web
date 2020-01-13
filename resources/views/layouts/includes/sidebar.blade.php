<div class="menu">
    @if (auth()->user()->role == Constant::USER_ROLES['admin'])
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
                </ul>
            </div>
        </div>
    @elseif(auth()->user()->role == Constant::USER_ROLES['student'])
        <div class="main-menu">
            <div class="scroll">
                <ul class="list-unstyled">
                    <li {!! Helper::routeIs('student.dashboard') ? 'class="active"' : '' !!}>
                        <a href="{{ route('student.dashboard') }}">
                            <i class="iconsminds-shop-4"></i>
                            <span>Tableau de bord</span>
                        </a>
                    </li>
                    <li {!! Helper::routeIs('student.students.classe') ? 'class="active"' : '' !!}>
                        <a href="{{ route('student.students.classe') }}">
                            <i class="iconsminds-business-man-woman"></i> Ma classe
                        </a>
                    </li>
                    <li {!! Helper::routeIs('student.students.course_calendar') ? 'class="active"' : '' !!}>
                        <a href="{{ route('student.students.course_calendar') }}">
                            <i class="simple-icon-calendar"></i> Mon Emploi
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    @elseif(auth()->user()->role == Constant::USER_ROLES['teacher'])
        <div class="main-menu">
            <div class="scroll">
                <ul class="list-unstyled">
                    <li {!! Helper::routeIs('teacher.dashboard') ? 'class="active"' : '' !!}>
                        <a href="{{ route('teacher.dashboard') }}">
                            <i class="iconsminds-shop-4"></i>
                            <span>Tableau de bord</span>
                        </a>
                    </li>
                    <li {!! Helper::routeIs('teacher.course_calendar') ? 'class="active"' : '' !!}>
                        <a href="{{ route('teacher.course_calendar') }}">
                            <i class="simple-icon-calendar"></i> Mon Emploi
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    @endif
    <div class="sub-menu"></div>
</div>
