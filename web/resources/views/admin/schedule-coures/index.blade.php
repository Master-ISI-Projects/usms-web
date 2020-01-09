@extends('layouts.master')

@section('title', 'Ajouter nouvelle classe')

@section('content')
	<div class="container-fluid">
		<div class="row">
            <div class="col-12">
                <h1>Nouvelle classe</h1>
                <div class="top-right-button-container mb-4">
                    <button data-url="{{ route('classes.index') }}" type="button" class="btn btn-primary btn-lg top-right-button link-type">Liste des classes</button>
                </div>
                <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                    <ol class="breadcrumb pt-0">
                        <li class="breadcrumb-item">
                            <a href="#">Tableau de board</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('classes.index') }}">Classes</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Nouveau classe</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="card h-100">
            <div class="card-body">
                <course-calendar :class-id="1"></course-calendar>
            </div>
        </div>
	</div>
@endsection

@section('plugin-stylesheet')
	<link rel="stylesheet" href="{{ asset('assets/css/vendor/fullcalendar.min.css') }}">
@endsection

@section('plugin-javascript')
	<script src="{{ asset('assets/js/vendor/moment.min.js') }}"></script>
	<script src="{{ asset('assets/js/vendor/fullcalendar.min.js') }}"></script>
	<script src="{{ asset('assets/js/vendor/locale-all.js') }}"></script>
@endsection

@section('custom-javascript')
	<script>
		$(document).ready(function () {
			$("#calendar").fullCalendar({
				header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay,listWeek'
                },
				themeSystem: "bootstrap4",
				height: "auto",
				defaultView: 'agendaWeek', 
                locale: 'fr',
                navLinks: true,
                editable: false,
                eventLimit: true,
                selectable: true,
                selectHelper: true,
				// buttonText: {
				// 	today: "Today",
				// 	month: "Month",
				// 	week: "Week",
				// 	day: "Day",
				// 	list: "List"
				// },
				bootstrapFontAwesome: {
					prev:" simple-icon-arrow-left",
					next:" simple-icon-arrow-right",
					prevYear:" simple-icon-control-start",
					nextYear:" simple-icon-control-end"
				},
				events: [
					{title:"Account",start:"2018-05-18"},
					{title:"Delivery",start:"2019-07-22",end:"2019-07-24"},
					{title:"Conference",start:"2019-06-07",end:"2019-06-09"},
					{title:"Delivery",start:"2019-09-03",end:"2019-09-06"},
					{title:"Meeting",start:"2019-06-17",end:"2019-06-18"},
					{title:"Taxes",start:"2019-08-07",end:"2019-08-09"}
				]
			});
			/*$('.calendar').fullCalendar
            ({
                // header:
                // {
                //     left: 'prev,next today',
                //     center: 'title',
                //     right: 'month,agendaWeek,agendaDay,listWeek'
                // },
                // defaultView: 'agendaWeek',
                // views:
                // {
                //     agenda:
                //     {
                //         axisFormat: 'HH:mm',
                //         timezone: 'local',
                //         columnFormat: 'dddd D/M'
                //     }
                // },

                select: function(start, end, allDay) {
                    console.log()
                },

                dayRender: function(date, cell) {
                    var currentDate = new Date();
                    if( date < currentDate )
                    {
                        $(cell).css({ backgroundColor : '#f7eaea'});
                        $('.fc-day[data-date="'+ date +'"]').css({ backgroundColor : '#f00'});
                    }
                },

                eventClick: function(calEvent, jsEvent, view) {
                    // var idRdv = calEvent.title.split("#")[1];
                    // viewInfoRdv(idRdv);
                }
            });*/
		})
	</script>
@endsection