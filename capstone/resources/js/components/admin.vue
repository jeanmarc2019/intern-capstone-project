<template>
    <div class="content">
        <div class="row justify-content-center mt-2">
            This is the admin side of the application.  Here, questions can be added with modifiers on the end result.
        </div>
        <button @click="makeQuestion">New Question</button>
        <button >New Response Template</button>
        <button @click="save">Save</button>
        <div class="row justify-content-center m-5 border border-dark" v-for="question in questions" v-bind:id="question.question_id">
            <span><button @click="remove(questions, question.question_id)">Delete Question</button></span>
            <span class="ml-lg-1">Importance {{question.modifier}}<b-form-input v-model="question.modifier" type="range" min="0" max="1" step="0.1"></b-form-input></span>
            <b-textarea v-model="question.questionName" placeholder="Enter question name"></b-textarea>
            <b-form-select v-model="question.type" :options="question.typeOptions"></b-form-select>
            <div v-if="question.type === 'custom'">
                <button @click="addCustomOptions(question)">Add Custom Option</button>
                <div class="row m-2" v-for="option in question.customOptions">
                    <span>
                        <button @click="remove(question.customOptions, option)">Delete Option</button>
                        <b-form-input v-model="option.optionTitle" placeholder="Enter option name"></b-form-input>
                        importance {{option.percentMod}}
                        <b-form-input v-model="option.percentMod" type="range" min="0" max="1" step="0.1"></b-form-input>
                    </span>
                </div>
            </div>
        </div>
        <button @click="makeQuestion" v-if="questions.length > 0">New Question</button>
        <button v-if="questions.length > 0">New Response Template</button>
        <button v-if="questions.length > 0" @click="save">Save</button>
    </div>
</template>
<script>
    import api from '../API.js'

    export default {
        name: "admin",
        data() {
            return {
                questions: [],
                customQuestions: [],
            }
        },
        methods: {
            makeQuestion() {
                this.questions.push(
                    {
                       questionName: "",
                       type: null,
                       modifier: "1",
                       typeOptions: [
                           {value: null, text: "Please select an option"},
                           {value: "boolean", text: "True or False"},
                           {value: "customBoilerplate", text: "Use a custom template"},
                           {value: "custom", text: "Make custom response"}
                       ],
                       customOptions: [],
                        question_id: Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15)
                    }
                );
            },
            addCustomOptions(question) {
                question.customOptions.push({
                    optionTitle: null,
                    percentMod: "1"
                });
            },
            save() {
                var output = [];
                for(let i = 0; i < this.questions.length; i++) {
                    let temp = {};
                    temp.question_id = this.questions[i].question_id;
                    temp.questionName = this.questions[i].questionName;
                    temp.modifier = this.questions[i].modifier;
                    temp.type = this.questions[i].type;
                    temp.customOptions = this.questions[i].customOptions;
                    output.push(temp);
                }
                api.saveQuestions(JSON.stringify(output));
            },
            remove(array, element) {
                var elementPos = array.map(function(x) {return x.question_id; }).indexOf(element);
                // var objectFound = array[elementPos];
                array.splice(elementPos, 1);
            }
        },
        created() {
            api.getQuestions()
                .then(response =>{
                    var output = [];
                    for(var i = 0; i < response.data.length; i++) {
                        let temp = {};
                        temp.question_id = response.data[i].question_id ?
                            response.data[i].question_id : Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15);
                        temp.questionName = response.data[i].questionName;
                        temp.type = response.data[i].type;
                        temp.modifier = response.data[i].modifier;
                        temp.customOptions = JSON.parse(response.data[i].customOptions);
                        temp.typeOptions = [
                            {value: null, text: "Please select an option"},
                            {value: "boolean", text: "True or False"},
                            {value: "customBoilerplate", text: "Use a custom template"},
                            {value: "custom", text: "Make custom response"}
                        ];
                        output.push(temp);
                    }
                    this.questions = output;
                })
                .catch(error => console.log(error))
        }
    }
</script>
<style scoped>
    html, body {
        background-color: #fff;
        color: #636b6f;
        font-family: 'Raleway', sans-serif;
        font-weight: 100;
        height: 100vh;
        margin: 0;
    }

    .full-height {
        height: 100vh;
    }

    .flex-center {
        align-items: center;
        display: flex;
        justify-content: center;
    }

    .position-ref {
        position: relative;
    }

    .top-right {
        position: absolute;
        right: 10px;
        top: 18px;
    }

    .content {
        text-align: center;
    }

    .title {
        font-size: 84px;
    }

    .links > a {
        color: #636b6f;
        padding: 0 25px;
        font-size: 12px;
        font-weight: 600;
        letter-spacing: .1rem;
        text-decoration: none;
        text-transform: uppercase;
    }

    .m-b-md {
        margin-bottom: 30px;
    }
</style>
