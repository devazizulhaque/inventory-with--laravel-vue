<template>
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Supplier</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><router-link :to="{name: 'dashboard'}"><i class="bx bx-home-alt"></i></router-link>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Supplier list</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <h5 class="mb-0">Supplier List</h5>
                <form class="ms-auto position-relative">
                    <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i class="bi bi-search"></i></div>
                    <input class="form-control ps-5" v-model="search" type="text" placeholder="search">
                </form>
            </div>
            <hr/>
            <div class="col">
                <!-- Button trigger modal -->
                <router-link :to="{name: 'supplier-add'}" type="button" class="btn btn-primary"><i class="fadeIn animated bx bx-user-plus"></i>Add Supplier</router-link>
            </div>
          <div class="table-responsive mt-3">
            <table class="table align-middle">
              <thead class="table-secondary">
                <tr>
                 <th>#</th>
                 <th>Name</th>
                 <th>Phone</th>
                 <th>Email</th>
                 <th>Address</th>
                 <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(supplier, index) in filteredSupplier" :key="supplier.id">
                 <td>{{ index + 1 }}</td>
                  <td>
                    <div class="d-flex align-items-center gap-3 cursor-pointer">
                       <img :src="'/' + supplier.photo" class="rounded-circle" width="44" height="44" alt="">
                       <div class="">
                         <p class="mb-0">{{ supplier.name }}</p>
                       </div>
                    </div>
                  </td>
                  <td>{{ supplier.phone }}</td>
                  <td>{{ supplier.email }}</td>
                  <td>{{ supplier.address }}</td>
                  <td>
                    <div class="table-actions d-flex align-items-center gap-3 fs-6">
                      <a type="button" data-bs-toggle="modal" data-bs-target="#supplierModal" class="text-primary" data-bs-placement="bottom" title="View" @click="showSupplierModal(supplier)" ><i class="bi bi-eye-fill"></i></a>
                        <!-- Modal -->
                        <SupplierSingle :supplier="selectedSupplier" />
                      <router-link :to="{ name: 'supplier-edit', params: { id: supplier.id } }" class="text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit">
                        <i class="bi bi-pencil-fill"></i>
                      </router-link>
                      <a @click="deleteSupplier(supplier.id)" class="text-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete"><i class="bi bi-trash-fill"></i></a>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
</template>

<script>
import SupplierSingle from '../../components/admin/supplier/SupplierSingle.vue'
import User from '../../Helpers/User';

export default {
    name: "SupplierView",
    components: {
      SupplierSingle
    },
    data() {
      return {
        search: '',
        suppliers: [],

        showModal: false, // Add a property to control the modal visibility
        selectedSupplier: null, // Store the selected employee data
      }
    },
    methods: {
      getSupplier() {
        axios.get('/api/supplier/')
        .then((response) => {
          this.suppliers = response.data;
        })
        .catch((error) => {
          Toast.fire({
              icon: 'error',
              title: 'Supplier Not Found!!!',
          });
        })
      },

      deleteSupplier(id) {
        Swal.fire({
          title: 'Are you sure?',
          text: "You want to delete this Supplier?",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#277da1',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {
            axios.delete('/api/supplier/' + id)
            .then((response) => {
              this.getSupplier();
              Swal.fire(
                'Deleted!',
                'Supplier has been deleted.',
                'success'
              )
            })
            .catch((error) => {
              Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Something went wrong!',
              })
            })
          }
        })
      },

      showSupplierModal(supplier) {
        this.selectedSupplier = supplier;
        this.showModal = true;
      },

    },
    computed: {
      filteredSupplier() {
        return this.suppliers.filter((supplier) => {
          return supplier.name.toLowerCase().includes(this.search.toLowerCase());
        })
      }
    },
    created() {
      this.getSupplier();
    },
}
</script>

<style>

</style>