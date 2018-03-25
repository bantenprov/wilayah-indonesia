<template>
  <div>
  <div id="">
    <div class="alert alert-info mb-5" role="alert">
          Data Successfully Process
    </div>
  </div>

    <h1>Formulir Provinsi</h1>
    <vue-form :state="formstate" :load="isiform" @submit.prevent="onSubmit" class="mb-3">
        <input type="hidden" name="post"/>
        <input type="hidden" v-model="model.id" name="id">
        <div class="col-sm mb-2">
          <validate tag="div">
            <label for="exampleInputEmail1">Kode Provinsi</label>
            <input class="form-control" v-model="model.id" name="id" placeholder="ID Provinsi">
            <field-messages name="id">
              <small class="form-text text-success">Bagus!</small>
              <small class="form-text text-danger" slot="required">Kode Provinsi harus diisi</small>
            </field-messages>
          </validate>
        </div>
        <div class="col-sm mb-2">
          <validate tag="div">
            <label for="exampleInputEmail1">Nama Provinsi</label>
            <input class="form-control" v-model="model.name" required name="name" placeholder="Nama Provinsi">
            <field-messages name="name">
              <small class="form-text text-success">Looks good!</small>
              <small class="form-text text-danger" slot="required">Name Provinsi harus diisi</small>
            </field-messages>
          </validate>
        </div>
        <div class="col-auto mb-2">
          <button class="btn btn-primary" type="submit">Submit</button>
        </div>
    </vue-form>
  </div>
</template>

<script>
export default {
  data () {
    return {
      formstate: {},
      model:{
        id: '',
        name: '',
        provinsi_f_ket: ''
      }
    }
  },
  created: function () {
  },
  mounted:function(){
    var ref     = this;
	if (typeof this.$route.params.id !== 'undefined'){
		console.log('Ada ID');
		ref.isiform(ref);
	}else{
		console.log('Gak Ada ID');		
	}
  },
  methods: {
    onSubmit: function (){
		if(this.formstate.$invalid) {
			return;
		}else{
			if (typeof this.$route.params.id !== 'undefined'){
				axios.post('/wilayah-indonesia/provinsi/'+this.$route.params.id+'/edit',{
					id : this.model.id,
					name : this.model.name
				})
				.then(function (response) {
					if(response.data.message === 'Success'){
						window.location.href = "/#/wilayah-indonesia/provinsi";
						//this.$router.push("provinsi");
					}else{
						Vue.swal(
							'Error!',
							'Gagal Simpan Data!',
							'error'
						)
					}
				})
				.catch(function (error) {
					console.log(error);
				});				
			}else{
				axios.post('/wilayah-indonesia/provinsi',{
					id : this.model.id,
					name : this.model.name
				})
				.then(function (response) {
					if(response.data.message === 'Success'){
						window.location.href = "/#/wilayah-indonesia/kabupaten";
						//this.$router.push("provinsi");
					}else{
						alert('Gagal Proses');
					}
				})
				.catch(function (error) {
					console.log(error);
				});				
			}
		}
    },
    isiform: function(ref){
		axios.get('/wilayah-indonesia/provinsi/'+ref.$route.params.id)
		.then(function (response) {
			if(response.data !== 'undefined'){
				ref.model.id   				= response.data.id,
				ref.model.name 				= response.data.name
			}
		});
    }
  }
}
</script>
