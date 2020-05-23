<template>
    <div>
        <el-row class="btn-add">
            <el-button icon="el-icon-circle-plus-outline" type="success" size="mini" plain>Thêm Mới</el-button>
        </el-row>
        <el-table :data="exams" border style="width: 100%">
            <el-table-column type="selection" align="center" width="55"></el-table-column>
            <el-table-column sortable prop="name" label="Tên đề thi"></el-table-column>
            <el-table-column sortable prop="question_number" label="Tổng số câu hỏi" width="180"></el-table-column>
            <el-table-column sortable prop="time" label="Thời gian thi" width="200"></el-table-column>
            <el-table-column width="120" label="Action" tex-align="center">
                <template>
                    <el-button icon="el-icon-edit" size="mini"></el-button>
                    <el-button size="mini" type="danger" icon="el-icon-delete"></el-button>
                </template>
            </el-table-column>
        </el-table>
        <el-pagination
            background
            layout="prev, pager, next"
            :total="100">
        </el-pagination>
    </div>
</template>

<script>
    export default {
        name: 'ListUserComponent',
        data() {
            return{
                exams: [
                    {
                        name: 'Exam 1',
                        question_number: 30,
                        time: 60,
                    },
                    {
                        name: 'Exam 2',
                        question_number: 30,
                        time: 60,
                    },
                    {
                        name: 'Exam 3',
                        question_number: 30,
                        time: 60,
                    },
                    {
                        name: 'Exam 4',
                        question_number: 30,
                        time: 60,
                    },
                    {
                        name: 'Exam 5',
                        question_number: 30,
                        time: 60,
                    },
                ],

            }
        },
        created() {
            if(!localStorage.getItem('access_token'))
            {
                this.$router.push({name: 'login'});
            }
        },
        methods: {

        }
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
