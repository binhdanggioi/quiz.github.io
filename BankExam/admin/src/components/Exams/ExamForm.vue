<template>
	<div>
		<h3>{{exam.name}}</h3>

	</div>
</template>

<script>
	export default{
		name: 'ExamFormComponent',
		data() {
			return{
				exam: {}
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
                    }
                    }).catch((errors) => {
                      console.log(errors);
                    });
			},
		},
	}
</script>

<style scoped>
	
</style>