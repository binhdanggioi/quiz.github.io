<template>
   <div class="login-form">
       <el-form :model="user" status-icon :rules="rules" ref="loginForm" label-width="120px" class="demo-ruleForm">
           <el-form-item label="Email" prop="email">
               <el-input type="text" v-model="user.email" size="small" autocomplete="off"></el-input>
           </el-form-item>
           <el-form-item label="Mật khẩu" prop="password">
               <el-input type="password" size="small" v-model="user.password" autocomplete="off"></el-input>
           </el-form-item>
           <el-form-item align="center">
               <el-button type="primary" size="small" @click="login('loginForm')">Đăng Nhập</el-button>
               <el-button type="default" size="small" >Đăng ký mới</el-button>
           </el-form-item>
       </el-form>
   </div>
</template>

<script>
export default {
    name: 'LoginComponent',
    props: {},
    data() {
        return {

            user: {
                email: '',
                password: '',
            },

            rules: {
              email: [
              { required: true, message: 'Vui lòng nhập địa chỉ email', trigger: 'blur' },
              { type: 'email', required: true, message: 'Email sai định dạng', trigger: 'blur' }
              ],
              password: [
              {required: true,message: 'Vui lòng nhập password', trigger: 'blur'}
              ]
            }
        }
    },
    methods:{
      login(formName) {
        this.$refs[formName].validate((valid) => {
          if (valid) {
           this.$axios.post('http://localhost:8000/api/v1/login',this.user)
            .then((res) => {
              if (res.status === 200) {
                localStorage.setItem('access_token',res.data.access_token);
                 this.$router.push({ name: 'exams' })
              }
            }).catch((errors) => {
              console.log(errors);
            });
          }
        });
      },
    }
}
</script>

<style>
.login-form{
    width: 612px;
    margin: 0px auto;
}
</style>
