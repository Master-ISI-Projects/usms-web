<template>
	<div>
		<div id="calendar" class="calendar-vue"></div>

		<div class="modal" id="modal-show-course" tabindex="-1" role="dialog" aria-hidden="true">
		    <div class="modal-dialog modal-dialog-centered" role="document">
		        <div class="modal-content">
		        	<div class="modal-header p-1rem br-0">
	                    <h5 class="modal-title" id="course-title">Title</h5>
	                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                        <span aria-hidden="true">&times;</span>
	                    </button>
	                </div>
	                <div class="modal-body p-1rem">
                        <p class="text-muted text-small mb-1">Classe</p>
                        <p class="mb-3" id="course-classe"></p>
                        <div class="separator"></div>
                        <p class="text-muted text-small mb-2 mt-3">Module</p>
                        <p class="mb-3" id="course-module"></p>
                        <div class="separator"></div>
                        <p class="text-muted text-small mb-2 mt-3">Date / Dureé</p>
                        <p class="mb-3" id="course-date-duration"></p>
                        <div v-if="!teacherId">
                        	<div class="separator"></div>
	                        <p class="text-muted text-small mb-2 mt-3">Enseignant</p>
	                        <p class="mb-0" id="course-teacher"></p>
                        </div>
					</div>
					<div class="modal-footer p-1rem">
                        <a href="" class="btn btn-success btn-sm" id="course-url">Consulter</a>
					</div>
		        </div>
		    </div>
		</div>
	</div>
</template>

<script>
    import courseService from '../services/CourseService'

    export default {
    	props: [
    		'classId', 
    		'teacherId'
    	],

        data() {
            return {
            	calendarConfig: {
	            	header: {
	                    left: 'prev,next today',
	                    center: 'title',
	                    right: 'month, agendaWeek, agendaDay'
	                },
	                views:
                    {
                        agenda:
                        {
                            axisFormat: 'HH:mm',
                            timezone: 'local',
                            columnFormat: 'dddd D/M'
                        }
                    },
	                allDaySlot: false,
					themeSystem: "bootstrap4",
					height: "500px",
					defaultView: 'month', 
	                locale: 'fr',
	                navLinks: true,
	                editable: false,
	                eventLimit: true,
	                selectable: false,
	                selectHelper: true,
					bootstrapFontAwesome: {
						prev:" simple-icon-arrow-left",
						next:" simple-icon-arrow-right",
						prevYear:" simple-icon-control-start",
						nextYear:" simple-icon-control-end"
					}
            	},
            	courses: []
            }
        },

        methods: {
        	loadCalendar() {
        		var action = (this.classId != null) 
        					? courseService.getCoursesOfClasse(this.classId) 
        					: courseService.getCoursesOfTeacher(this.teacherId)
	            action.then(response => {
		                var self = this
		                self.courses = response.data.courses
		                $("#calendar").fullCalendar({
							...self.calendarConfig,
							eventClick: function (...args) {
								self.showCourse(...args)
							},
							events: self.courses
						})
		            })
		            .catch(error => {
		                console.log(error)
		            })
            },

            showCourse(calEvent, jsEvent, view) {
				$('#modal-show-course .modal-header').css('background', calEvent.backgroundColor)
				$('#modal-show-course .modal-header').css('color', calEvent.color)
				$('#modal-show-course #course-title').text(calEvent.title)
				$('#modal-show-course #course-classe').text(calEvent.classeName)
				$('#modal-show-course #course-module').text(calEvent.module)
				$('#modal-show-course #course-date-duration').text(calEvent.dateDeration)
				$('#modal-show-course #course-teacher').text(calEvent.teacher)
				$('#modal-show-course #course-url').attr('href', calEvent.courseUrl)
            	$('#modal-show-course').modal();
            }
        },

        mounted() {  
            this.loadCalendar()
        }
    }
</script>

<style type="text/css" scoped>
	.fc-time-grid-event .fc-content {
	    font-weight: 700 !important;
	    font-size: 12px !important;
	}

	.fc-event, .fc-event-dot {
	    border-radius: 10px !important;
	}
</style>