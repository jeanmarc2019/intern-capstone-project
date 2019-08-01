import axios from 'axios'

export default {
    getQuestions() {
        return axios.get('/api/questions').then(response =>{ return response})
    },
    saveQuestions(data) {
        return axios.post('/api/admin/save', data)
            .then(function (response) {
                alert("Questions have been saved");
                console.log(response);
            })
            .catch(function (error) {
                console.log(error);
            })
    }
}
