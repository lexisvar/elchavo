<template>
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="/elchavo#/">Vecindad</a>
            </li>
            <li class="breadcrumb-item active">Habitante</li>
        </ol>

        <form>
            <div class="form-group">
                <div class="form-row">
                    <div class="col-md-12">
                        <multiselect style="margin-bottom: 10px" v-model="title" track-by="id" label="value" placeholder="Selecciona un título" :options="titles" :searchable="false" :allow-empty="false"></multiselect>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-6">
                        <div class="form-label-group">
                            <input v-model="name" type="text" id="firstName" class="form-control" placeholder="First name" required="required" autofocus="autofocus">
                            <label for="firstName">Nombre</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-label-group">
                            <input v-model="nick" type="text" id="lastName" class="form-control" placeholder="Last name" required="required">
                            <label for="lastName">Apodo</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="form-row">
                    <div class="col-md-6">
                        <img :src="img_src" height="200">
                    </div>
                    <div class="col-md-6">
                        <div class="form-label-group">
                            <picture-input
                                ref="pictureInput"
                                width="200"
                                height="200"
                                margin="16"
                                accept="image/jpeg,image/png"
                                size="10"
                                button-class="btn"
                                :custom-strings="uploader.translate"
                                @change="onChange">
                            </picture-input>
                        </div>
                    </div>

                </div>

            </div>
            <div class="form-group">
                <div class="form-row">
                    <div class="col-md-6">
                        <div class="form-label-group">
                            <a class="btn btn-primary btn-block" href="/elchavo#/vecindad">Volver</a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-label-group">
                            <a class="btn btn-primary btn-block" href="javascript:void(0);" v-on:click="save">Guardar</a>
                        </div>
                    </div>
                </div>
            </div>

        </form>
    </div>
</template>

<script>
    import PictureInput from 'vue-picture-input'


    export default {
        name: "habitante",
        data(){
            return{
                name:"",
                id:0,
                nick:"",
                foto:"",
                max_files : 2,
                value: '',
                titles: [
                    {id:'don', value:'Don'},
                    {id:'dona', value:'Doña'},
                    {id:'sr', value:'Señor'},
                    {id:'sra', value:'Señora'},
                    {id:'srta', value:'Señorita'},
                    {id:'lic', value:'Licenciado'},
                ],
                title:{},
                uploader:{
                    translate: {
                        upload: '<p>Su dispositivo no es soportado.</p>', // HTML allowed
                        drag: 'Arrastre una imagen o <br>de click aquí para subir una foto', // HTML allowed
                        tap: 'Tap here to select a photo <br>from your gallery', // HTML allowed
                        change: 'Cambiar Foto', // Text only
                        remove: 'Remover Foto', // Text only
                        select: 'Seleccionar Foto', // Text only
                        selected: '<p>Photo successfully selected!</p>', // HTML allowed
                        fileSize: 'The file size exceeds the limit', // Text only
                        fileType: 'This file type is not supported.', // Text only
                        aspect: 'Landscape/Portrait' // Text only
                    }
                },
                img_src : 'https://www.gravatar.com/avatar/00000000000000000000000000000000?d=mp'
            }
        },
        components:{
            PictureInput
        },
        methods:{
            save(){
                let data={
                    'id': this.id,
                    'title' : this.title.id,
                    'name' : this.name,
                    'nick' : this.nick,
                    'foto' : this.foto,
                }
                this.axios.post("habitante",data).then((response) => {
                    console.log(response)
                    this.$router.push('/vecindad')
                })
            },
            onChange (image) {
                console.log('New picture selected!')
                if (image) {
                    console.log('Foto Cargada.')
                    this.foto = image
                } else {
                    console.log('FileReader API not supported: use the <form>, Luke!')
                }
            },
            getHabitante(){
                this.axios.get("get_habitante/"+this.id).then((response) => {
                    $("#grid-loader").hide()
                    if(response.data.title!=="" && response.data.title!==null){
                        let index =_.findIndex(this.titles, function(o) { return o.id === response.data.title; });
                        this.title = {
                            'id':response.data.title,
                            'value':this.titles[index].value
                        }

                    }
                    this.name = response.data.name
                    this.nick = response.data.nick
                    if(response.data.foto!==""){
                        this.img_src = 'uploads/'+response.data.foto
                    }else{
                        this.img_src = 'https://www.gravatar.com/avatar/00000000000000000000000000000000?d=mp'
                    }
                })
            }
        },

        created(){
            if(this.$route.params.id!==0){
                this.id = this.$route.params.id;
                this.getHabitante();
            }else{
                this.title = {}
                this.name = ""
                this.nick = ""
                this.img_src = 'https://www.gravatar.com/avatar/00000000000000000000000000000000?d=mp'
            }
        }
    }
</script>

<style scoped>

</style>
