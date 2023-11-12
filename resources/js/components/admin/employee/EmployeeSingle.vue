<template>
    <div class="modal fade" id="employeeModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
                <div class="modal-content" v-if="employee">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ employee.name }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-6">
                                <img :src="'/' + employee.photo" alt="">
                            </div>
                            <div class="col-6">
                                <table class="table table-borderless">
                                    <tr>
                                        <td class="header">Name:</td>
                                        <td>{{ employee.name }}</td>
                                    </tr>
                                    <tr>
                                        <td class="header">Phone:</td>
                                        <td>{{ employee.phone }}</td>
                                    </tr>
                                    <tr>
                                        <td class="header">Email:</td>
                                        <td>{{ employee.email }}</td>
                                    </tr>
                                    <tr>
                                        <td class="header">Address:</td>
                                        <td>{{ employee.address }}</td>
                                    </tr>
                                    <tr>
                                        <td class="header">Position:</td>
                                        <td>{{ employee.position }}</td>
                                    </tr>
                                    <tr>
                                        <td class="header">Salary:</td>
                                        <td>{{ employee.salary }}</td>
                                    </tr>
                                </table>
                                    
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "EmployeeSingle",
    props: {
        employee: Object,
    },
    data() {
        return {
            //
        }
    },
    methods: {
        //
    },
    mounted() {
        //
    }
}
</script>

<style scoped>
.table tr .header{
    text-align: end;
    font-weight: bold;
    width: 30%;
    padding-right: 30px;
}
</style>