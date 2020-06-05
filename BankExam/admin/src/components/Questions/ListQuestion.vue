<template>
    <div>
        <el-row class="btn-add">
            <el-button icon="el-icon-circle-plus-outline" type="success" size="mini" plain @click="formCreate()">Thêm Mới</el-button>
        </el-row>
        <el-table v-loading="loading" :data="questions" border style="width: 100%">
            <el-table-column type="selection" align="center" width="55"></el-table-column>
            <el-table-column sortable prop="content" label="Nội dung câu hỏi"></el-table-column>
            <el-table-column width="120" label="Action" tex-align="center">
                <template slot-scope="scope">
                    <el-button icon="el-icon-edit" size="mini" @click="editQuestion(scope.row.id)"></el-button>
                    <el-button size="mini" type="danger" icon="el-icon-delete" @click="deleteQuestion(scope.row.id)"></el-button>
                </template>
            </el-table-column>
        </el-table>
        <el-pagination background layout="prev, pager, next"
        @current-change="changePage"
         :total="totalRecord">
        </el-pagination>
    </div>
</template>

<script>
    export default {
        name: 'ListQuestionComponent',
        data() {
            return{
                questions: [],
                loading: false,
                totalRecord: 0,
                currentPage: 1,
                sort: 'column=id&sort=desc'
            }
        },
        created() {
            if(!localStorage.getItem('access_token'))
            {
                this.$router.push({name: 'login'});
            }
            this.getQuestions();
        },
        methods: {
            getQuestions() {
                this.loading = true;
                this.$axios.get(`api/v1/questions?page=${this.currentPage}&${this.sort}`).then((res) => {
                    if (res.status === 200) {
                        this.questions = res.data.questions;

                        this.totalRecord = res.data.meta.total;

                    }
                    this.loading = false;
            }).catch((errors) => {
              this.$message({type: 'warning',message:errors.message});
            });
            },
            editQuestion(id) {
                this.$router.push({name: 'questions.edit',params: {id: id} });

            },
            deleteQuestion(id) {
                this.$confirm('Bạn chắc chắn muốn xóa chứ?', 'Warning', {
                      confirmButtonText: 'OK',
                      cancelButtonText: 'Cancel',
                      type: 'warning'
                    }).then(() => {
                        this.$axios.delete(`api/v1/questions/${id}`).then((res) => {
                            if (res.status === 200) {
                                this.getQuestions();
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
            changePage(page) {
                this.currentPage = page;
                this.getQuestions();
            },
            formCreate() {
                this.$router.push({name: 'questions.create'});
            },

        },
    }
</script>

<style scoped>
    .btn-add{
        display: flex;
        justify-content: flex-end;
        padding-bottom: 20px;
    }
    .el-pagination{
        display: flex;
        justify-content: center;
        margin-top: 15px;
    }
</style>
