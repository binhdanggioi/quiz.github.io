<template>
	<div>
		<el-row class="btn-add1">
			<h3>{{exam.name}}</h3>
            <el-button icon="el-icon-circle-plus-save" type="success" size="mini" @click="attach()" style="float: right!important;">Lưu lại</el-button>
        </el-row>
		<el-table v-loading="loading" @selection-change="handleSelectionChange" :data="questions" border style="width: 100%">
            <el-table-column type="selection" align="center" width="55"></el-table-column>
            <el-table-column sortable prop="content" label="Nội dung câu hỏi"></el-table-column>
        </el-table>
        <el-pagination background layout="prev, pager, next"
        @current-change="changePage"
         :total="totalRecord">
        </el-pagination>
	</div>
</template>

<script>
	export default{
		name: 'ExamFormComponent',
		data() {
			return{
				exam: {},
				questions: [],
				questionIds: [],
                loading: false,
                totalRecord: 0,
                currentPage: 1,
                sort: 'column=id&sort=desc'
			}
		},
		created() {
			if (this.$route.params.id) {
				this.showExam(this.$route.params.id);
			}
		},
		methods: {
			showExam(id) {
				this.$axios.get(`api/v1/exams/${id}`).then((res) => {
                    if (res.status === 200) {
                        this.exam = res.data.exam;
                        this.getQuestions();
                    }
                    }).catch((errors) => {
                      console.log(errors);
                    });
			},
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
            changePage(page) {
                this.currentPage = page;
                this.getQuestions();
            },
            handleSelectionChange(ids) {let data = [];
            ids.forEach((item) => {data.push({question_id: item.id});});
            this.questionIds = data;
            },
      attach() {
			let exam = {
				name: this.exam.name,
				questions: this.questionIds
			};
			this.$axios.put(`api/v1/exams/${this.exam.id}`,exam).then((res) => {
                    if (res.status === 200) {
                        this.$message({type: 'success',message: 'Thêm câu hỏi thành công'});
                    }
                }).catch((errors) => {
                    this.$message({type: 'error',message: errors.message});
                });
		},
		},
	}

</script>

<style scoped>

</style>