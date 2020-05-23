eslint-disable 
<template>
	<div>
		<el-form ref="form" :model="question" label-width="150px">
  <el-form-item label="Tên câu hỏi">
    <el-input type="textarea" v-model="question.content"></el-input>
  </el-form-item>
  <el-collapse v-model="activeName">
  <el-collapse-item :title="'đáp án số ' + (index + 1)" :name="(index + 1)" :key="index" v-for="(answer,index) in question.answers">
    <el-row>
  <el-col :span="20"><el-input type="textarea" v-model="answer.content"></el-input></el-col>
  <el-col :span="2"><el-checkbox size="medium" v-model="answer.correct"></el-checkbox></el-col>
  <el-col :span="2"><el-button type="danger" size="mini" icon="el-icon-delete" @click="removeAnswer(index)"></el-button></el-col>
</el-row>
  </el-collapse-item>
</el-collapse>
<el-row>
  <el-button size="mini" icon="el-icon-circle-plus-outline" type="primary" @click="addAnswer()">Thêm đáp án</el-button>
</el-row>
  <el-form-item align="center">
    <el-button type="primary" @click="onSubmit">Lưu lại</el-button>
    <el-button>Cancel</el-button>
  </el-form-item>
</el-form>
	</div>
</template>

<script>
	export default {
		name: 'QuestionForm',
		data() {
			return {
				activeName: 1,
				question: {
         content: '',
         answers: [
         {content: '',correct: false},{content: '',correct: false}],
        }
			}
		},
		created() {
			if(this.$route.params.id){
				console.log(this.$route.params.id)
			this.showQuestion(this.$route.params.id);
		}
		},
		methods: {
			showQuestion(id) {
				this.$axios.get(`api/v1/questions/${id}`).then((res) => {
                    if (res.status === 200) {
                        this.question = res.data.question;
                    }
                    }).catch((errors) => {
                      console.log(errors);
                    });
			},
			addAnswer() {
				if (this.question.answers.length >= 4) {
					this.$message({type: 'error',message: 'Mỗi câu hỏi chỉ tối đa 4 đáp án'});
					return false;
				}
				this.question.answers.push({
					content: '',
					correct: false,
				})
			},
			removeAnswer(index) {
				if (this.question.answers.length <=2) {
					this.$message({type: 'warning', message: 'Mỗi câu hỏi phải tối thiểu 2 đáp án'});
					return false;
				}
				this.question.answers.splice(index, 1);
			},
			onSubmit() {
				this.CreateOrUpdateQuestion();
			},
			CreateOrUpdateQuestion() {
				if(this.$route.params.id){
					this.$axios.put(`api/v1/questions/${this.$route.params.id}`,this.question).then((res) => {
                    if (res.status === 200) {
                        this.$router.push({name: 'questions'});
                    }
                    }).catch((errors) => {
                      console.log(errors);
                    });
				}
				else{
					this.$axios.post(`api/v1/questions`,this.question).then((res) => {
                    if (res.status === 200) {
                        this.$router.push({name: 'questions'});
                    }
                    }).catch((errors) => {
                      console.log(errors);
                    });
				}
			}
		},
	}
</script>

<style scoped>

</style>