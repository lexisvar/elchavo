<template>
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="/">El Chavo</a>
            </li>
            <li class="breadcrumb-item active">Vecindad</li>
        </ol>

        <!-- Page Content -->
        <h1>La Vecindad del Chavo del 8</h1>
        <hr>
        <div class="card mb-3">
            <div class="card-header">
                <i class="fas fa-table"></i>
                Lista de habitantes de la vecindad</div>
            <div class="card-body">
                <div class="row fa-pull-right">
                    <a class="btn btn-primary btn-block" href="/elchavo#/habitante/0" style="margin-bottom: 10px; margin-right: 15px">Nuevo Habitante</a>
                </div>
                <div class="table-responsive">
                    <vue-good-table
                        :columns="columns"
                        :rows="habitantes">
                        <template slot="table-row" slot-scope="props">

                            <span v-if="props.column.field == 'title'">
                                <span v-if="props.row.title=='don'"> Don </span>
                                <span v-if="props.row.title=='dona'"> Doña </span>
                                <span v-if="props.row.title=='sr'"> Señor </span>
                                <span v-if="props.row.title=='sra'"> Señora </span>
                                <span v-if="props.row.title=='srta'"> Señorita </span>
                                <span v-if="props.row.title=='lic'"> Licenciado </span>
                            </span>
                            <span v-else>
                                                              {{props.formattedRow[props.column.field]}}

                            </span>

                            <span v-if="props.column.field == 'photo'">
                                <img :src="'uploads/'+props.row.foto" height="80" v-if="props.row.foto!=''">
                                <img src="https://www.gravatar.com/avatar/00000000000000000000000000000000?d=mp" height="80" v-else>
                            </span>
                            <span v-else>
                            </span>

                            <span v-if="props.column.field == 'edit'">
                              <span > <a :href="'/elchavo#/habitante/'+props.row.id"><i class="fas fa-edit"></i></a> </span>
                            </span>
                            <span v-else-if="props.column.field == 'edit'">
                              after
                            </span>
                            <span v-else>
                            </span>

                            <span v-if="props.column.field == 'delete'">
                              <span > <a v-on:click="deleteHabitante(props.row.id)" href="javascript:void(0);" ><i class="fas fa-trash"></i></a> </span>
                            </span>
                                                    <span v-else-if="props.column.field == 'delete'">
                              after
                            </span>
                                                    <span v-else>
                            </span>
                        </template>
                    </vue-good-table>
                </div>
            </div>
            <div class="card-footer small text-muted">Laravel 5.7 + VueJS + MySQL</div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "vecindad",
        data(){
            return{
                habitantes:[],
                columns: [
                    {
                        label: 'Título',
                        field: 'title',
                    },
                    {
                        label: 'Nombre',
                        field: 'name',
                    },
                    {
                        label: 'Apodo',
                        field: 'nick',
                    },
                    {
                        label: 'Foto',
                        field: 'photo',
                    },
                    {
                        label: 'Editar',
                        field: 'edit',
                    },
                    {
                        label: 'Borrar',
                        field: 'delete',
                    },
                ],
            }
        },
        methods:{
            getAll(){
                this.axios.get("get_all_habitantes").then((response) => {
                    $("#grid-loader").hide()
                    this.habitantes = response.data
                })
            },
            deleteHabitante(habitante_id){
                this.axios.delete("delete_habitante/"+habitante_id).then((response) => {
                    console.log(response)
                    this.getAll()

                })
            }
        },
        computed:{

        },
        created(){
            this.getAll()
        }
    }
</script>

<style scoped>

</style>
