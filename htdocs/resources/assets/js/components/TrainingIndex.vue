<template>
    <div class="training-index">
        <div class="s-flex s-justify-end">
            <a href="#" @click.prevent="$modal.show('training')">Add training</a>
        </div>
        <div>
            <table>
                <thead>
                <tr>
                    <th scope="col">Category</th>
                    <th scope="col">Name</th>
                    <th scope="col">Date completed</th>
                    <th scope="col">Expiry date</th>
                    <th scope="col">Accredited</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th scope="row">Health and Safety</th>
                    <td>HS Pass Plus</td>
                    <td>30 June 2018</td>
                    <td>30 June 2019</td>
                    <td>Yes</td>
                    <td><a href="#" @click.prevent="$modal.show('training')">Change</a> <a href="">Delete</a></td>
                </tr>
                <tr>
                    <th scope="row">Health and Safety</th>
                    <td>HS Pass Plus</td>
                    <td>30 June 2018</td>
                    <td>30 June 2019</td>
                    <td>Yes</td>
                    <td><a href="#" @click.prevent="$modal.show('training', q)">Change</a> <a href="">Delete</a></td>
                </tr>
                <tr>
                    <th scope="row">Health and Safety</th>
                    <td>HS Pass Plus</td>
                    <td>30 June 2018</td>
                    <td>30 June 2019</td>
                    <td>Yes</td>
                    <td><a href="#" @click.prevent="$modal.show('training')">Change</a> <a href="">Delete</a></td>
                </tr>
                </tbody>
            </table>
        </div>
        <modal name="training" height="auto">
            <div class="modal">
                <div class="modal-content">
                    <form-builder label="Select category" v-model="value" field="category" :options="d_options" type="select" />
                    <form-builder label="Name of training" v-model="value" field="name" type="text" />
                    <form-builder label="Date completed" v-model="value" field="completed_at" type="date" />
                    <form-builder label="Expiry date" v-model="value" field="expires_at" type="date" />
                    <form-builder label="Is this training accredited?" v-model="value" field="accredited" type="radio-list" :options="d_accredited_list"  />
                </div>
                <hr>
                <div class="modal-actions">
                    <input type="submit" @click.prevent="$modal.hide('training')" class="button" value="Save" />
                    <a href="" @click.prevent="$modal.hide('training')">Cancel</a>
                </div>
            </div>
        </modal>
    </div>
</template>
<script>
    export default {
        name: 'TrainingIndex',
        data(){
            return {
                d_options: [
                    {
                        text: 'Category 1',
                        value: 1
                    },
                    {
                        text: 'Category 2',
                        value: 2
                    },
                    {
                        text: 'Category 3',
                        value: 3
                    }
                ],
                d_accredited_list: [
                    {
                        text: 'Yes',
                        value: 1
                    },
                    {
                        text: 'No',
                        value: 2
                    }
                ],
                value: ''
            }
        }
    }
</script>