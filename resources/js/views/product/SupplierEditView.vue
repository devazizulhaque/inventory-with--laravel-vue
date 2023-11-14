<template>
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Supplier</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><router-link :to="{name: 'dashboard'}"><i class="bx bx-home-alt"></i></router-link>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Supplier Edit</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="row">
        <div class="col-xl-9 mx-auto">
            <div class="p-4 border rounded">
                <form @submit.prevent="supplierUpdate" enctype="multipart/form-data">
                    <div class="card-title d-flex align-items-center">
                        <h5 class="mb-0">Supplier Edit</h5>
                    </div>
                    <hr/>
                    <div class="row mb-3">
                        <label for="inputEnterYourName" class="col-sm-3 col-form-label">Enter Supplier Name</label>
                        <div class="col-sm-9">
                            <small class="text-danger" v-if="errors.name">{{ errors.name[0] }}</small>
                            <input type="text" class="form-control" id="inputEnterYourName" placeholder="Enter Your Name" v-model="form.name">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputPhoneNo2" class="col-sm-3 col-form-label">Phone No</label>
                        <div class="col-sm-9">
                            <small class="text-danger" v-if="errors.phone">{{ errors.phone[0] }}</small>
                            <input type="text" class="form-control" id="inputPhoneNo2" placeholder="Phone No" v-model="form.phone">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmailAddress2" class="col-sm-3 col-form-label">Email Address</label>
                        <div class="col-sm-9">
                            <small class="text-danger" v-if="errors.email">{{ errors.email[0] }}</small>
                            <input type="email" class="form-control" id="inputEmailAddress2" placeholder="Email Address" v-model="form.email">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="inputAddress4" class="col-sm-3 col-form-label">Address</label>
                        <div class="col-sm-9">
                            <small class="text-danger" v-if="errors.address">{{ errors.address[0] }}</small>
                            <textarea class="form-control" id="inputAddress4" rows="3" placeholder="Address" v-model="form.address"></textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputSalary" class="col-sm-3 col-form-label">Shop Name</label>
                        <div class="col-sm-9">
                            <small class="text-danger" v-if="errors.shopname">{{ errors.shopname[0] }}</small>
                            <input type="text" class="form-control" id="inputShopname" placeholder="Enter Shop Name" v-model="form.shopname">
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <label for="inputPhoto" class="col-sm-3 col-form-label">Photo</label>
                        <div class="col-sm-5">
                            <small class="text-danger" v-if="errors.photo">{{ errors.photo[0] }}</small>
                            <input type="file" class="form-control" id="inputPhoto" placeholder="Choose Photo" @change="onFileSelected">
                        </div>
                        <div class="col-sm-4">
                            <img v-if="form.newPhoto" :src="form.newPhoto" alt="" width="100">
                            <img v-else :src="'/' + form.photo" alt="" width="100">
                        </div>
                    </div>

                    <div class="row">
                        <label class="col-sm-3 col-form-label"></label>
                        <div class="col-sm-9">
                            <button type="submit" class="btn btn-primary px-5">Register</button>
                        </div>
                    </div>
                </form>
            </div> 
        </div>
    </div>
</template>

<script>
export default {
    name: "SupplierEditView",
    data() {
        return {
            form: {
                name: '',
                phone: '',
                email: '',
                address: '',
                shopname: '',
                photo: '',
                newPhoto: '',
            },
            errors: {},
        }
    },
    methods: {
        onFileSelected(event) {
            let file = event.target.files[0];
            if (file.size > 1048770) {
                Toast.fire({
                    icon: 'error',
                    title: 'File size should be less than 1 MB.',
                })
            }
            else{
                this.form.newPhoto = URL.createObjectURL(file);

                let reader = new FileReader();
                reader.onload = (e) => {
                    this.form.newPhoto = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        },
        
        supplierUpdate() {
            axios.put('/api/supplier/' + this.$route.params.id, this.form)
            .then((response) => {
                if (response.data.success === true) {
                    this.$router.push({ name: 'supplier' });
                    Toast.fire({
                        icon: 'success',
                        title: response.data.message,
                    });
                }
                else{
                    Toast.fire({
                        icon: 'error',
                        title: response.data.message,
                    });
                }
            })
            .catch((error) => {
                Toast.fire({
                    icon: 'error',
                    title: 'Something went wrong!!!',
                });
            })
        },
    },
    mounted() {
        axios.get('/api/supplier/' + this.$route.params.id)
        .then((response) => {
            this.form = response.data;

        })
        .catch((error) => {
            Toast.fire({
                icon: 'error',
                title: 'Employee Not Found!!!',
            });
        })
    }
}
</script>

<style>

</style>