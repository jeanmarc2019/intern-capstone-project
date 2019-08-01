<template>
    <div class="content">
        <div v-if="!isOn" class="flex position-ref full-height">
            <div class="flex-center row title m-b-md">
                TBI Screener
            </div>
            <div class="flex-center row m-b-md">
                <button @click="toggle">Start</button>
            </div>
        </div>
        <div v-else-if="isOn" class="flex">
            <div class="flex-center row m-b-md">
                <button @click="toggle">Go back</button>
            </div>
            <div class="flex-center m-3" v-for="question in questions">
                <span class="mr-2" :id="question.question_id + '_' + question.modifier">
                    {{question.questionName}}:
                </span>
                <div>
                    <span v-if="question.type === 'boolean'">
                        <b-form-group>
                              <b-form-radio v-model="question.value" name="true" value="1">True</b-form-radio>
                              <b-form-radio v-model="question.value" name="false" value="0">False</b-form-radio>
                        </b-form-group>
                    </span>
                    <div v-else="question.type === 'custom'">
                        <b-form-checkbox-group placeholder="Please select an option" v-model="question.value" :options="question.customOptions"></b-form-checkbox-group>
                    </div>

                </div>
            </div>
            <div class="flex-center row m-b-md">
                <button @click="toggle">Go back</button>
            </div>
        </div>
    </div>
</template>
<script>
    import api from '../API.js'

    export default {
        name: "test",
        data() {
            return {
                isOn: false,
                questions: []
            }
        },
        methods: {
            toggle() {
                this.isOn = !this.isOn
            },
            formatDropdown(options) {
                let out = [];
                for(var i = 0; i < options.length; i++) {
                    out.push({text: options[i].optionTitle, value: options[i].percentMod})
                }

                return out;
            }
        },
        created() {
            api.getQuestions()
                .then(response =>{
                    var output = [];
                    for(var i = 0; i < response.data.length; i++) {
                        let temp = {};
                        temp.question_id = response.data[i].question_id;
                        temp.questionName = response.data[i].questionName;
                        temp.type = response.data[i].type;
                        temp.modifier = response.data[i].modifier;
                        temp.customOptions = this.formatDropdown(JSON.parse(response.data[i].customOptions));
                        temp.value = "";
                        output.push(temp);
                    }
                    this.questions = output;
                })
                .catch(error => console.log(error))
        },
        computed: {
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
