<template>
    <div>
        <el-row class="btn-add">
            <el-button icon="el-icon-circle-plus-outline" type="success" size="mini" @click="drawer = true" plain>Thêm Mới</el-button>
        </el-row>
        <el-table :data="exams" v-loading="loading" border style="width: 100%">
            <el-table-column type="selection" align="center" width="55"></el-table-column>
            <el-table-column sortable prop="name" label="Tên đề thi" width="661"></el-table-column>
            <el-table-column sortable prop="question_number" align="center" label="Tổng số câu hỏi" width="130" :formatter="getQuestionNumber"></el-table-column>
            <el-table-column sortable prop="time" label="Thời gian thi" width="130"></el-table-column>
            <el-table-column width="185" label="Action" align="center">
                <template slot-scope="scope">
                     <el-button icon="el-icon-info" size="mini" @click="detail(scope.row.id)"></el-button>
                    <el-button icon="el-icon-edit" size="mini" @click="edit(scope.row.id)"></el-button>
                    <el-button size="mini" type="danger" icon="el-icon-delete" @click="deletebyid(scope.row.id)"></el-button>
                </template>
            </el-table-column>
        </el-table>
        <el-pagination background layout="prev, pager, next"
        @current-change="changePage"
         :total="totalRecord">
        </el-pagination>

        <el-drawer title="Thêm mới đề thi" :visible.sync="drawer" :with-header="true">
            <el-row class="form-exam">
                <el-form :model="examForm" size="mini" :rules="rules" ref="examForm" label-position="top">
                    <el-form-item prop="name" label="Tên đề thi">
                        <el-input v-model="examForm.name" placeholder="Tên đề thi"></el-input>
                    </el-form-item>

                    <el-form-item prop="question_number" label="Tổng số câu hỏi">
                        <el-input v-model="examForm.question_number" placeholder="Tổng số câu hỏi"></el-input>
                    </el-form-item>

                    <el-form-item prop="time" label="Thời gian thi">
                        <el-input v-model="examForm.time" placeholder="Thời gian thi"></el-input>
                    </el-form-item>

                    <el-form-item align="center">
                        <el-button type="success" @click="validate('examForm')">Lưu lại</el-button>
                        <el-button @click="drawer = false" :with-header="true" type="danger">Hủy</el-button>
                    </el-form-item>
                </el-form>
            </el-row>
        </el-drawer>
    </div>
</template>

<script>
    export default {
        name: 'ListExamComponent',
        data() {
            return {
                loading: false,
                exams: [],
                examForm:{
                    name: '',
                    question_number: '',
                    time: '',
                },
                totalRecord: 0,
                currentPage: 1,
                drawer: false,
                sort: 'column=id&sort=desc',
                rules: {
                      name: [
                      { required: true, message: 'Vui lòng nhập tên đề thi', trigger: 'blur' }
                      ],
                      question_number: [
                      {required: true,message: 'Vui lòng nhập số câu hỏi', trigger: 'blur'}
                      ],
                      time: [
                      {required: true,message: 'Vui lòng nhập thời gian thi', trigger: 'blur'},
                      ]
                },   

            }
        },
        created() {
            if(!localStorage.getItem('access_token'))
            {
                this.$router.push({name: 'login'});
            }
            this.getExams();
        },
        methods: {
            getExams() {
                this.loading = true;
                this.$axios.get(`api/v1/exams?page=${this.currentPage}&${this.sort}`).then((res) => {
                    if (res.status === 200) {
                        this.exams = res.data.exams;

                        this.totalRecord = res.data.meta.total;

                    }
                    this.loading = false;
            }).catch((errors) => {
              this.$message({type: 'warning',message:errors.message});
            });
            },
            validate(formName){
                this.$refs[formName].validate((valid) => {
                    if(valid){ 
                        this.examForm.id ? this.update() : this.store();
                    }
                })
            },
            detail(id) {
                this.$router.push({name: 'exams.detail', params: {id: id}});
            },
            edit(id) {
                this.$axios.get(`api/v1/exams/${id}`).then((res) => {
                    if (res.status === 200) {
                        this.drawer = true;
                        this.examForm = res.data.exams;
                    }
                    }).catch((errors) => {
                      console.log(errors);
                    });
            },
            store() {
                   this.$axios.post(`api/v1/exams`,this.examForm).then((res) => {
                    if (res.status === 200) {
                        this.getExams();
                    }
                    }).catch((errors) => {
                      console.log(errors);
                    });
            },
            changePage(page) {
                this.currentPage = page;
                this.getExams();
            },
            update() {
                this.$axios.put(`api/v1/exams/${this.examForm.id}`,this.examForm).then((res) => {
                    if (res.status === 200) {
                        this.getExams();
                    }
                }).catch((errors) => {
                    console.log(errors);
                });
            },
            deletebyid(id) {

                 this.$confirm('Bạn chắc chắn muốn xóa chứ?', 'Warning', {
                      confirmButtonText: 'OK',
                      cancelButtonText: 'Cancel',
                      type: 'warning'
                    }).then(() => {
                        this.$axios.delete(`api/v1/exams/${id}`).then((res) => {
                            if (res.status === 200) {
                                this.getExams();
                            }
                        }).catch((errors) => {
                            console.log(errors);
                        });
                    }).catch(() => {
                      this.$message({
                        type: 'info',
                        message: 'Delete canceled'
                      });          
                    });
            },
            getQuestionNumber(row){
                return row.questions.length;
            }
        }
    }
</script>

<style scoped>
.btn-add{
    display: flex;
    justify-content: flex-end;
    padding-bottom: 20px;
    font-size: 22px!important;
    border:none;
}
.el-pagination{
    display: flex;
    justify-content: center;
    margin-top: 15px;
}
.form-exam{
    padding:20px;
}
</style>
