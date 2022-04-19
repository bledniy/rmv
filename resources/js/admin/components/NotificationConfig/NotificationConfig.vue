<template>
    <div class="config">
        <div class="list" v-if="list">
            <table class="table">
                <tr>
                    <th>ID</th>
                    <th>Название</th>
                </tr>
                <tr v-for="config in list">
                    <td>{{ config.id }}</td>
                    <td>
                        <input :key="config.id" placeholder="Название" class="form-control" type="text"
                               v-model="list[config.id].name"
                               name="name" v-on:change="update(config.id)">
                    </td>
                </tr>
            </table>
        </div>
    </div>
</template>

<script>
    import lodash from 'lodash'

    export default {
        name: "notification-config",
        props: [
            'url',
        ], mounted() {
            this.getList();
        },
        data() {
            return {
                list: []
            }
        },
        methods: {
            getList() {
                this.axios.get(this.buildUrl())
                    .then(({data}) => {
                        console.log(data.data)
                        this.list = lodash.keyBy(data.data, 'id')
                    })
            },
            buildUrl(id = null) {
                if (!id) {
                    return this.url;
                }
                return `${this.url}/${id}`;
            },
            update(id) {
                this.axios.put(this.buildUrl(id), this.list[id])
                    .then(({data}) => {
                        this.$notify(data.message)
                    })
            }
        }
    }
</script>

<style scoped>

</style>