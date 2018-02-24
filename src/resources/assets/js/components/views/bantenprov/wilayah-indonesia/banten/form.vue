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
            <label for="exampleInputEmail1">Nama Provinsi</label>
            <input class="form-control" v-model="model.provinsi_f_nama" required name="provinsi_f_nama" placeholder="Nama Provinsi">
            <field-messages name="provinsi_f_nama">
              <small class="form-text text-success">Looks good!</small>
              <small class="form-text text-danger" slot="required">Name is a required field</small>
            </field-messages>
          </validate>
        </div>
        <div class="col-sm mb-2">
          <validate tag="div">
            <label for="exampleInputEmail1">Keterangan</label>
            <input class="form-control" v-model="model.provinsi_f_ket" name="provinsi_f_ket" placeholder="Keterangan">

            <field-messages name="provinsi_f_ket">
              <small class="form-text text-success">Looks good!</small>
              <small class="form-text text-danger" slot="required">Name is a required field</small>
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
        provinsi_f_nama: '',
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
				axios.post('/provinsi/update/'+this.$route.params.id,{
					id : this.model.id,
					provinsi_f_nama : this.model.provinsi_f_nama,
					provinsi_f_ket  : this.model.provinsi_f_ket
				})
				.then(function (response) {
					if(response.data.message === 'Success'){
						window.location.href = "/#/provinsi/home";
					}else{
						alert('Gagal Proses');
					}
				})
				.catch(function (error) {
					console.log(error);
				});				
			}else{
				axios.post('/provinsi/create',{
					id : this.model.id,
					provinsi_f_nama : this.model.provinsi_f_nama,
					provinsi_f_ket  : this.model.provinsi_f_ket
				})
				.then(function (response) {
					if(response.data.message === 'Success'){
						window.location.href = "/#/provinsi/home";
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
		axios.get('/provinsi/read/'+ref.$route.params.id)
		.then(function (response) {
			if(response.data !== 'undefined'){
				ref.model.id   				= response.data.id,
				ref.model.provinsi_f_nama 	= response.data.provinsi_f_nama,
				ref.model.provinsi_f_ket  	=  response.data.provinsi_f_ket				
			}
		});
    }
  }
}
</script>
