<template>
    <div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form class="form-body" @submit.prevent="register">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Employee Add</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col mx-auto">
                                <div class="p-4 rounded">
                                    <div class="row mb-3">
                                        <label for="inputEnterYourName" class="col-sm-3 col-form-label">Enter Your Name</label>
                                        <small class="text-danger" v-if="errors.name">{{ errors.name[0] }}</small>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="inputEnterYourName" placeholder="Enter Your Name" v-model="form.name">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputPhoneNo2" class="col-sm-3 col-form-label">Phone No</label>
                                        <small class="text-danger" v-if="errors.phone">{{ errors.phone[0] }}</small>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="inputPhoneNo2" placeholder="Phone No" v-model="form.phone">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputEmailAddress2" class="col-sm-3 col-form-label">Email Address</label>
                                        <small class="text-danger" v-if="errors.email">{{ errors.email[0] }}</small>
                                        <div class="col-sm-9">
                                            <input type="email" class="form-control" id="inputEmailAddress2" placeholder="Email Address" v-model="form.email">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputChoosePassword2" class="col-sm-3 col-form-label">Choose Password</label>
                                        <small class="text-danger" v-if="errors.password">{{ errors.password[0] }}</small>
                                        <div class="col-sm-9">
                                            <input type="email" class="form-control" id="inputChoosePassword2" placeholder="Choose Password" v-model="form.password">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputConfirmPassword2" class="col-sm-3 col-form-label">Confirm Password</label>
                                        <small class="text-danger" v-if="errors.password_confirmation">{{ errors.password_confirmation[0] }}</small>
                                        <div class="col-sm-9">
                                            <input type="email" class="form-control" id="inputConfirmPassword2" placeholder="Confirm Password" v-model="form.password_confirmation">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="inputAddress4" class="col-sm-3 col-form-label">Address</label>
                                        <small class="text-danger" v-if="errors.address">{{ errors.address[0] }}</small>
                                        <div class="col-sm-9">
                                            <textarea class="form-control" id="inputAddress4" rows="3" placeholder="Address" v-model="form.address"></textarea>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    name: "EmployeeCreate",
    data() {
        return {
            form: {
                name: '',
                phone: '',
                email: '',
                password: '',
                password_confirmation: '',
                address: '',
            },
            errors: {},
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

<style>

</style>