<template>
    <div>
        <div class="p-4">
            <h5 class="mb-2 mt-2">Chat</h5>
            <div class="separator mb-4"></div>
            <div class="scroll ps ps--active-y h-100 mb-2 chat-content" id="messages">
                <div class="clearfix">
                    <div v-for="message in messages">
                        <div :key="message.id" :class="{ 'my-message float-right': message.userId == userId }" class="card d-inline-block mb-3 float-left mr-2">
                            <div class="position-absolute pt-1 pr-2 r-0">
                                <!--span class="text-extra-small text-muted">{{ message.createdAt }}</span-->
                            </div>
                            <div class="card-body chat-message">
                                <div v-if="message.userId != userId" class="d-flex flex-row">
                                    <div class="d-flex flex-grow-1 min-width-zero">
                                        <div class="mb-1 pl-0 align-self-center d-flex flex-column flex-lg-row justify-content-between min-width-zero">
                                            <div class="min-width-zero">
                                                <p class="mb-0 text-muted truncate">{{ message.userName }}</p>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="chat-text-left">
                                    <p class="mb-0">{{ message.content }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>

                </div>
            </div>
            <div class="comment-contaiener pt-2">
                <div class="input-group pt-2">
                    <input type="text" class="form-control" v-on:keyup.enter="sentMessage()" v-model="message.content" placeholder="Message...">
                    <div class="input-group-append">
                        <button type="button" @click="sentMessage()" class="btn btn-secondary pl-0"><i class="simple-icon-arrow-right ml-2"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <a class="app-menu-button d-inline-block d-xl-none" href="#">
            <i class="simple-icon-options"></i>
        </a>
    </div>
</template>

<script>
    import courseService from '../services/CourseService'

    export default {
        props: ['courseId', 'userId'],

        data() {
            return {
                message: {
                    content: '',
                    course_id: this.courseId,
                    userId: this.userId
                },
                messages: []
            }
        },

        methods: {
            runEchoListener() {
                Echo.private('course-chat-' + this.courseId)
                    .listen('MessageSent', (event) => {
                        if(event.message.userId != this.userId) {
                            this.messages.push(event.message)
                            this.scrollTop()
                        }
                    })
            },

            getCourseMessages() {
                courseService.getCourseMessages(this.courseId)
                    .then(response => {
                        this.messages = response.data.messages
                        this.scrollTop()
                    })
                    .catch(error => {
                        console.log(error)
                    })
            },

            sentMessage() {
                this.message.content = this.message.content.trim()
                if(this.message.content != '') {
                    var message = { ...this.message }
                    this.messages.push(message)
                    this.scrollTop()
                    this.message.content = ''
                    courseService.sentMessage(message)
                        .catch(error => {
                            console.log(error)
                        })
                }
            },

            scrollTop() {
                $("#messages").animate({scrollTop: 2000000}, "slow")
            }
        },

        mounted() {
            this.getCourseMessages()
            this.runEchoListener()
        }
    }
</script>

<style type="text/css" scoped>
    .clearfix:after {
        content: '';
        display: block;
        clear: both;
    }
    .clear{
        clear: both;
    }
    .chat-text-left {
        max-width: 280px;
    }
</style>
