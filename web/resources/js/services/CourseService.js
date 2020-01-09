import axios from 'axios';
import Constants from '../constants/Constants';

class CourseService {
    
    async getCourseMessages (courseId) {
        const response = await axios.get(`${Constants.API_URL}/api/courses/${courseId}/messages`);

        return response;
    }

    async sentMessage (message) {
        const response = await axios.post(`${Constants.API_URL}/api/courses/${message.course_id}/messages`, message);

        return response;   
    }

    async getCoursesOfClasse (classeId) {
        const response = await axios.get(`${Constants.API_URL}/api/classes/${classeId}/courses`);

        return response;   
    }

    async getCoursesOfTeacher (teacherId) {
        const response = await axios.get(`${Constants.API_URL}/api/teachers/${teacherId}/courses`);

        return response;   
    }
}

export default new CourseService();