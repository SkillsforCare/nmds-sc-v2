<template>
    <div class="f-wizard">
        <div class="f-navigation">
            <div class="f-section" v-for="section in d_structure">
                <h2>{{ section.name }}</h2>
                <ul v-if="section.categories[0].name !== section.name">
                    <li v-for="category in section.categories">
                        <span v-if="!category.selected"><a href="#" @click.prevent="selectCategory(category)">{{ category.name }}</a></span>
                        <span v-else><strong>{{ category.name }}</strong></span>
                    </li>
                </ul>
            </div>

            <div class="f-section">
                <h2><a href="#">Summary</a></h2>
            </div>
        </div>
        <div class="f-content">
            <div v-for="section in d_structure">
                <div v-if="category.selected" v-for="category in section.categories">
                    <h3 class="heading-medium">{{ section.name }} <small v-if="category.location">({{ category.location }})</small></h3>
                    <small v-if="category.name !== section.name">{{ category.name }}</small>
                    <hr>
                    <form-builder v-for="question in category.questions" :label="question.question" v-model="question.answer.answer" :field="question.field" :type="question.type" :options="question.options" help_text="" />
                    <hr>
                    <div class="f-footer">
                        <a href="" v-if="category.prev_category" @click.prevent="prevCategory(category)" >Prev</a>
                        <div>
                            <a href="">Save progress</a>
                            <button class="button" v-if="category.next_category" @click="nextCategory(category)">Next</button>

                        </div>
                    </div>
                </div>
            </div>

            <div v-if="false">
                asd
                <question-index :questions="summary"></question-index>
            </div>
        </div>

    </div>
</template>
<script>
    export default {
        name: 'f-wizard',
        data() {
            return {
                d_structure: [
                    {
                        id: 1,
                        name: 'Start',
                        selected: true,
                        categories: [
                            {
                                id: 1,
                                location: null,
                                prev_category: null,
                                next_category: 2,
                                name: 'Start',
                                selected: true,
                                questions: [
                                    {   entity_id: 1,
                                        entity_type: 'worker', question: 'Name / Worker ID', answer: { answer: 'text', text: 'Test' }, field: 'worker1', type: 'text' },
                                    {   entity_id: 1,
                                        entity_type: 'worker', question: 'Job title', answer: 'Test', field: 'worker2', type: 'select' }
                                ]
                            }
                        ],
                        order: 1
                    },
                    {
                        id: 2,
                        name: 'Personal Details',
                        categories: [
                            {
                                id: 2,
                                location: '1 of 4',
                                prev_category: 1,
                                next_category: 3,
                                name: 'Basic details',
                                selected: false,
                                questions: [
                                    {   entity_id: 1,
                                        entity_type: 'worker',question: 'NI Number', answer: '', field: 'worker1', type: 'text' },
                                    {   entity_id: 1,
                                        entity_type: 'worker',question: 'Postcode', answer: '', field: 'worker2', type: 'text' },
                                    {   entity_id: 1,
                                        entity_type: 'worker', question: 'Date of birth', answer: '', field: 'worker2', type: 'date' },
                                    {
                                        entity_id: 1,
                                        entity_type: 'worker',
                                        question: 'Gender', answer: '', field: 'worker2', type: 'radio-list',
                                        options: [
                                            {
                                                'text': 'Male',
                                                'value': 0
                                            },
                                            {
                                                'text': 'Female',
                                                'value': 0
                                            },
                                            {
                                                'text': 'Unspecified',
                                                'value': 0
                                            }
                                        ]
                                    }
                                ]
                            },
                            {
                                id: 3,
                                location: '2 of 4',
                                prev_category: 2,
                                next_category: 4,
                                name: 'Disability',
                                selected: false,
                                questions: [
                                    {
                                        entity_id: 1,
                                        entity_type: 'worker',
                                        question: 'Any disability?', answer: '', field: 'worker2', type: 'radio-list',
                                        options: [
                                            {
                                                'text': 'Yes',
                                                'value': 0
                                            },
                                            {
                                                'text': 'No',
                                                'value': 0
                                            }
                                        ]
                                    }
                                ]
                            },
                            {
                                id: 4,
                                location: '3 of 4',
                                prev_category: 3,
                                next_category: 5,
                                name: 'Ethnic origin',
                                selected: false,
                                questions: [
                                    {
                                        entity_id: 1,
                                        entity_type: 'worker',
                                        question: 'Ethnic origin', answer: '', field: 'worker2', type: 'radio-list',
                                        options: [
                                            {
                                                'text': 'British (including English, Scottish, Welsh and Northern Irish)',
                                                'value': 0
                                            },
                                            {
                                                'text': 'Irish',
                                                'value': 0
                                            },
                                            {
                                                'text': 'Citizen of a different country',
                                                'value': 0
                                            }
                                        ]
                                    }
                                ]
                            },
                            {
                                id: 5,
                                location: '4 of 4',
                                prev_category: 4,
                                next_category: 6,
                                name: 'Born in UK',
                                selected: false,
                                questions: [
                                    {
                                        entity_id: 1,
                                        entity_type: 'worker',
                                        question: 'Born in UK', answer: '', field: 'worker2', type: 'radio-list',
                                        options: [
                                            {
                                                'text': 'Yes',
                                                'value': 0
                                            },
                                            {
                                                'text': 'No',
                                                'value': 1
                                            },
                                            {
                                                'text': 'Unknown',
                                                'value': 0
                                            }
                                        ]
                                    }
                                ]
                            }
                        ],
                        order: 2
                    },
                    {
                        id: 3,
                        name: 'Employment Details',
                        categories: [
                            {
                                id: 6,
                                location: '1 of 2',
                                prev_category: 5,
                                next_category: 7,
                                name: 'Employment status',
                                selected: false,
                                questions: [
                                    {
                                        entity_id: 1,
                                        entity_type: 'worker',
                                        question: 'Employment Status', answer: '', field: 'worker2', type: 'radio-list',
                                        options: [
                                            {
                                                'text': 'Permanent',
                                                'value': 0
                                            },
                                            {
                                                'text': 'Temporary',
                                                'value': 1
                                            },
                                            {
                                                'text': 'Agency',
                                                'value': 0
                                            }
                                        ]
                                    },
                                    { label: 'Start Date', answer: '', field: 'worker2', type: 'date' },
                                ]
                            },
                            {
                                id: 7,
                                location: '2 of 2',
                                prev_category: 6,
                                next_category: 8,
                                name: 'Experience',
                                selected: false,
                                questions: [
                                    {
                                        entity_id: 1,
                                        entity_type: 'worker',
                                        question: 'How many years experience?', answer: '', field: 'worker2', type: 'radio-list',
                                        options: [
                                            {
                                                'text': '1',
                                                'value': 0
                                            },
                                            {
                                                'text': '2',
                                                'value': 1
                                            }
                                        ]
                                    }
                                ]
                            }
                        ],
                        order: 3
                    },

                ],
                answer: ''
            }
        },
        computed: {

            summary() {
                let flat_array = {};

                let sections = this.d_structure;

                sections.forEach(function(section) {
                    console.log(section)

                    section.categories.forEach(function(category) {
                        flat_array[section.name] = category.questions
                    })
                });

                return flat_array;
            },

            flat_categories() {

                let flat_array = [];

                let sections = this.d_structure;

                sections.forEach(function(section) {

                    section.categories.forEach(function(category) {
                        flat_array.push(category)
                    });

                });

                return flat_array;
            },

        },
        methods: {
            nextCategory(current) {
                current.selected = false
                let category = this.flat_categories.filter(x => x.id === current.next_category)[0]
                category.selected = true
            },

            prevCategory(current) {
                current.selected = false
                let category = this.flat_categories.filter(x => x.id === current.prev_category)[0]
                category.selected = true
            },

            selectCategory(category) {

                this.resetCategories()
                category.selected = true
            },

            resetCategories() {
                let category = this.flat_categories.filter(x => x.selected === true)[0]
                category.selected = false
            }


        }
    }
</script>