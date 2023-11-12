<template>
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Employee</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><router-link :to="{name: 'dashboard'}"><i class="bx bx-home-alt"></i></router-link>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Employee list</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <h5 class="mb-0">Employee Details</h5>
                <form class="ms-auto position-relative">
                    <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i class="bi bi-search"></i></div>
                    <input class="form-control ps-5" v-model="search" type="text" placeholder="search">
                </form>
            </div>
            <hr/>
            <div class="col">
                <!-- Button trigger modal -->
                <router-link :to="{name: 'employee-add'}" type="button" class="btn btn-primary"><i class="fadeIn animated bx bx-user-plus"></i>Add Employee</router-link>
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
                 <th>Position</th>
                 <th>Salary</th>
                 <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(employee, index) in filteredEmployee" :key="employee.id">
                 <td>{{ index + 1 }}</td>
                  <td>
                    <div class="d-flex align-items-center gap-3 cursor-pointer">
                       <img :src="'/' + employee.photo" class="rounded-circle" width="44" height="44" alt="">
                       <div class="">
                         <p class="mb-0">{{ employee.name }}</p>
                       </div>
                    </div>
                  </td>
                  <td>{{ employee.phone }}</td>
                  <td>{{ employee.email }}</td>
                  <td>{{ employee.address }}</td>
                  <td>{{ employee.position }}</td>
                  <td>{{ employee.salary }}</td>
                  <td>
                    <div class="table-actions d-flex align-items-center gap-3 fs-6">
                      <a type="button" data-bs-toggle="modal" data-bs-target="#employeeModal" class="text-primary" data-bs-placement="bottom" title="View" @click="showEmployeeModal(employee)" ><i class="bi bi-eye-fill"></i></a>
                        <!-- Modal -->
                        <EmployeeSingle :employee="selectedEmployee" />
                      <router-link :to="{ name: 'employee-edit', params: { id: employee.id } }" class="text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit">
                        <i class="bi bi-pencil-fill"></i>
                      </router-link>
                      <a @click="deleteEmployee(employee.id)" class="text-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete"><i class="bi bi-trash-fill"></i></a>
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
import EmployeeSingle from '../../components/admin/employee/EmployeeSingle.vue'
import User from '../../Helpers/User';

export default {
    name: "EmployeeView",
    components: {
      EmployeeSingle
    },
    data() {
      return {
        search: '',
        employees: [],

        showModal: false, // Add a property to control the modal visibility
        selectedEmployee: null, // Store the selected employee data
      }
    },
    methods: {
      getEmployee() {
        axios.get('/api/employee/')
        .then((response) => {
          this.employees = response.data;
        })
        .catch((error) => {
          Toast.fire({
              icon: 'error',
              title: 'Employee Not Found!!!',
          });
        })
      },

      deleteEmployee(id) {
        Swal.fire({
          title: 'Are you sure?',
          text: "You want to delete this employee?",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#277da1',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {
            axios.delete('/api/employee/' + id)
            .then((response) => {
              this.getEmployee();
              Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
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

      showEmployeeModal(employee) {
        this.selectedEmployee = employee;
        this.showModal = true;
      },

    },
    computed: {
      filteredEmployee() {
        return this.employees.filter((employee) => {
          return employee.name.toLowerCase().includes(this.search.toLowerCase());
        })
      }
    },
    created() {
      this.getEmployee();
    },
}
</script>

<style>

</style>