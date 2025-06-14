<template>
  <div class="container">
    <div>
      <div class="heading"><h3>Enforcers</h3></div>
    </div>

    <div>
      <el-button @click="openForm">Create Enforcer</el-button>
    </div>
    <el-table :data="users">
      <el-table-column label="Image" align="center">
        <template #default="scope">
          <img :src="scope.row.image" />
        </template>
      </el-table-column>
      <el-table-column label="Enforcer Name">
        <template #default="scope">
          {{ `${scope.row.firstName} ${scope.row.lastName}` }}
        </template>
      </el-table-column>

      <el-table-column label="Assigned To" prop="fieldName" />
      <el-table-column label="Area Assigned" prop="areaName" />
      <el-table-column label="Status">
        <template #default="scope">
          <el-tag v-if="scope.row.status == 'Up'" type="success">{{ scope.row.status }}</el-tag>
          <el-tag v-else type="danger">{{ scope.row.status }}</el-tag>
        </template>
      </el-table-column>
      <el-table-column label="Operation" align="center">
        <template #default="scope">
          <el-button size="small">Edit</el-button>
          <el-button size="small" type="danger" @click="deleteUser(scope.row.userId)"
            >Remove</el-button
          >
        </template>
      </el-table-column>
    </el-table>
  </div>

  <el-dialog v-model="dialog.enforcer" width="600" :before-close="closeForm">
    <camera
      ref="camera"
      :resolution="{ width: 800, height: 600 }"
      autoplay
      playsinline
      facingMode="environment"
    ></camera>
    <div class="snapshot_btn">
      <el-button v-if="!isCameraPaused" @click="snapshot">Take Photo</el-button>
      <el-button v-else @click="snapshot">Reset</el-button>
    </div>
    <el-form
      class="enforcer_form"
      v-if="isCameraPaused"
      label-position="top"
      @submit.prevent="submitForm"
    >
      <div class="information">
        <el-form-item :rules="[required]" label="First Name">
          <el-input v-model="form.firstName" placeholder="Enter First Name" />
        </el-form-item>
        <el-form-item :rules="[required]" label="Last Name">
          <el-input v-model="form.lastName" placeholder="Enter Last Name" />
        </el-form-item>
        <el-form-item :rules="[required]" label="Email">
          <el-input v-model="form.email" placeholder="Enter Email" />
        </el-form-item>
        <el-form-item :rules="[required]" label="Phone">
          <el-input v-model="form.phone" placeholder="Enter Phone" />
        </el-form-item>
        <el-form-item :rules="[required]" label="Birth Date">
          <el-date-picker
            format="MM-DD-YYYY"
            v-model="form.birthDate"
            placeholder="Pick Birth Date"
            class="w-100"
          />
        </el-form-item>
        <el-form-item :rules="[required]" label="Gender">
          <el-radio-group v-model="form.gender">
            <el-radio :value="'Male'" label="Male" size="large" />
            <el-radio :value="'Female'" label="Female" size="large" />
          </el-radio-group>
        </el-form-item>
      </div>
      <div class="assign">
        <el-form-item :rules="[required]" label="Role">
          <el-select v-model="form.roleId" filterable>
            <el-option
              v-for="role in roles"
              :key="role.roleId"
              :label="role.roleName"
              :value="role.roleId"
            />
          </el-select>
        </el-form-item>
        <el-form-item v-show="form.roleId == 2" :rules="[required]" label="Field">
          <el-select v-model="form.fieldId" filterable :filter-method="getFields">
            <el-option
              v-for="field in fields"
              :key="field.fieldId"
              :label="field.fieldName"
              :value="field.fieldId"
            />
          </el-select>
        </el-form-item>
        <el-form-item v-show="form.roleId == 2" :rules="[required]" label="Area Assign">
          <el-select v-model="form.areaId" filterable :filter-method="getAreas">
            <el-option
              v-for="area in areas"
              :key="area.areaId"
              :label="area.areaName"
              :value="area.areaId"
            />
          </el-select>
        </el-form-item>
      </div>
      <div class="submit_btn">
        <el-button type="primary" @click="submitForm">Confirm</el-button>
      </div>
    </el-form>
  </el-dialog>
</template>

<script>
import axios from 'axios'
import { ElMessage, ElMessageBox } from 'element-plus'
import Camera from 'simple-vue-camera'
import { ref } from 'vue'
export default {
  components: { Camera },
  setup() {
    const camera = ref(null)

    return { camera }
  },
  data() {
    return {
      userSearch: '',
      userPagination: {
        currentPage: 1,
        elementsPerPage: 10,
      },
      required: {
        required: true,
      },
      users: [],
      roles: [],
      fields: [],
      areas: [],

      dialog: {
        enforcer: false,
      },

      isCameraPaused: false,
      form: {
        roleId: '',
        fieldId: '',
        areaId: '',
        firstName: '',
        lastName: '',
        email: '',
        phone: '',
        birthDate: '',
        gender: 'Male',
        imageName: '',
        imageExtension: '',
      },
    }
  },
  methods: {
    getRoles() {
      axios.get(`${this.api}/role`).then((response) => {
        this.roles = response.data
      })
    },
    getFields(e) {
      axios.get(`${this.api}/field?search=${e}`).then((response) => {
        this.fields = response.data.results
      })
    },
    getAreas(e) {
      axios.get(`${this.api}/area?search=${e}`).then((response) => {
        this.areas = response.data.results
      })
    },
    getUsers() {
      axios
        .get(
          `${this.api}/user?search=${this.userSearch}&currentPage=${this.userPagination.currentPage}&elementsPerPage=${this.userPagination.elementsPerPage}`,
        )
        .then((response) => {
          this.users = response.data.results
        })
    },
    deleteUser(studentId) {
      ElMessageBox.confirm('Are you sure you want to delete this user?', 'Warning', {
        confirmButtonText: 'OK',
        cancelButtonText: 'Cancel',
        type: 'warning',
      })
        .then(() => {
          axios.delete(`${this.api}/user/${studentId}`).then((response) => {
            ElMessage.success(response.data)
            this.getUsers()
          })
        })
        .catch(() => {})
    },
    submitForm() {
      const data = {
        roleId: this.form.roleId,
        fieldId: this.form.fieldId,
        areaId: this.form.areaId,
        firstName: this.form.firstName,
        lastName: this.form.lastName,
        email: this.form.email,
        phone: this.form.phone,
        birthDate: this.form.birthDate,
        gender: this.form.gender,
        imageName: this.form.imageName,
        imageExtension: this.form.imageExtension,
      }
      axios.post(`${this.api}/user`, data).then((response) => {
        ElMessage.success(response.data)
      })
    },

    closeForm() {
      this.dialog.enforcer = !this.dialog.enforcer
      this.$refs.camera.pause()
      this.isCameraPaused = false
      this.form.imageName = ''
    },

    openForm() {
      this.dialog.enforcer = !this.dialog.enforcer
      this.$refs.camera.start()
      this.form.imageName = ''
    },

    async snapshot() {
      if (!this.isCameraPaused) {
        const blob = await this.$refs.camera.snapshot()

        const reader = new FileReader()
        reader.readAsDataURL(blob)
        reader.onload = (e) => {
          this.form.imageName = e.target.result.split(',')[1]
        }

        await this.$refs.camera.pause()

        this.form.imageExtension = blob.type.split('/')[1]
      } else {
        this.form.imageName = ''
        await this.$refs.camera.resume()
      }
      this.isCameraPaused = !this.isCameraPaused
    },
  },
  mounted() {
    this.getUsers()
    this.getRoles()
    this.getFields()
    this.getAreas()
  },
}
</script>

<style scoped>
.heading h3 {
  font-weight: bold;
}
.snapshot_btn {
  text-align: center;
  margin: 10px 0;
}
.enforcer_form {
  display: flex;
  position: relative;
  column-gap: 20px;
}
.assign {
  width: 50%;
}

.information {
  width: 50%;
}

.submit_btn {
  position: absolute;
  right: 0;
  bottom: 0;
}
.cell img {
  width: 128px;
}
</style>
