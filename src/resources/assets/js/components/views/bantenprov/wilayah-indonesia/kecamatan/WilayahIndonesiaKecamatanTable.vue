<template>
  <div>

    <div class="d-flex justify-content-between align-items-center mb-3">
      <vuetable-filter-bar></vuetable-filter-bar>
      <div>
        <div v-if="loading" class="d-flex justify-content-start align-items-center">
          <i class="fa fa-refresh fa-spin fa-fw"></i>
          <span>Loading...</span>
        </div>
      </div>
    </div>
	
    <vuetable ref="vuetable"
      api-url="/wilayah-indonesia/kecamatan"
      :fields="fields"
      :sort-order="sortOrder"
      :css="css.table"
      pagination-path=""
      :per-page="5"
      :append-params="moreParams"
      @vuetable:pagination-data="onPaginationData"
      @vuetable:loading="onLoading"
      @vuetable:loaded="onLoaded">

      <template slot="actions" slot-scope="props">
        <div class="table-button-container">
          <button class="btn btn-warning btn-sm mr-1 mb-1" @click="editRow(props.rowData)">
            <span class="fa fa-pencil"></span> Edit
          </button>
          <button class="btn btn-danger btn-sm mr-1 mb-1" @click="deleteRow(props.rowData)">
            <span class="fa fa-trash"></span> Delete
          </button>
        </div>
      </template>

    </vuetable>
	Tabel Provinsi
    <div class="d-flex justify-content-between align-items-center">
      <div>
        <div v-if="loading" class="d-flex justify-content-start align-items-center">
          <i class="fa fa-refresh fa-spin fa-fw"></i>
          <span>Loading...</span>
        </div>
      </div>
      <vuetable-pagination ref="pagination"
        :css="css.pagination"
        @vuetable-pagination:change-page="onChangePage">
      </vuetable-pagination>
    </div>

  </div>
</template>

<script>
export default {
  data () {
    return {
      loading: true,
      fields: [
        {
          name: 'province_name',
          title: 'Name Provinsi',
          sortField: 'province_name'
        },
        {
          name: 'city_name',
          title: 'Nama Kabupaten',
          sortField: 'city_name'
        },
        {
          name: 'district_name',
          title: 'Nama Kecamatan',
          sortField: 'district_name'
        },
        '__slot:actions'
      ],
      sortOrder: [
        { field: 'province_name', direction: 'asc' },
        { field: 'city_name', direction: 'asc' },
        { field: 'district_name', direction: 'asc' }
      ],
      moreParams: {},
      css: {
        table: {
          tableClass: 'table table-bordered table-hover table-responsive-xl',
          ascendingIcon: 'fa fa-chevron-up',
          descendingIcon: 'fa fa-chevron-down'
        },
        pagination: {
          wrapperClass: 'vuetable-pagination btn-group',
          activeClass: 'active',
          disabledClass: 'disabled',
          pageClass: 'btn btn-light',
          linkClass: 'btn btn-light',
          icons: {
            first: 'fa fa-angle-double-left',
            prev: 'fa fa-angle-left',
            next: 'fa fa-angle-right',
            last: 'fa fa-angle-double-right'
          }
        }
      }
    }
  },
  methods: {
    onPaginationData(paginationData) {
      this.$refs.pagination.setPaginationData(paginationData);
    },
    onChangePage(page) {
      this.$refs.vuetable.changePage(page);
    },
    editRow(rowData){
      window.location.href = "/#/provinsi/update/"+rowData.id;
      //alert("You clicked edit on"+ JSON.stringify(rowData));
    },
	deleteRow(rowData){
		Vue.swal({
		  title: 'Are you sure?',
		  text: 'You couldn\'t recover your data!',
		  type: 'warning',
		  showCancelButton: true,
		  confirmButtonText: 'Delete',
		  cancelButtonText: 'Cancel'
		}).then((result) => {
			console.log(result);
			if (result.value) {
				axios.post('/provinsi/delete/'+rowData.id)
				.then(function (response){
					if(response.data.message === 'Fail'){
						Vue.swal(
							'Error!',
							'Error deleting data!',
							'error'
						)
					}
				})
				.catch(function (error){
					Vue.swal(
						'Error!',
						'Error deleting data!',
						'error'
					)
				});
			}else if(result.dismiss === swal.DismissReason.cancel){
				/*
				Vue.swal(
					'Cancelled',
					'Your imaginary file is safe :)',
					'error'
				)
				*/
			}
			this.$refs.vuetable.refresh();			
		})
    },
    onLoading: function () {
      this.loading = true;
      // console.log('Loading: ' + this.loading);
    },
    onLoaded: function () {
      this.loading = false;
      // console.log('Loading: ' + this.loading);
    },
	reload: function(){
		this.$refs.vuetable.reload();
	}
  },
  events: {
    'filter-set' (filterText) {
      this.moreParams = {
        filter: filterText
      }
      Vue.nextTick( () => this.$refs.vuetable.refresh() )
    },
    'filter-reset' () {
      this.moreParams = {}
      Vue.nextTick( () => this.$refs.vuetable.refresh() )
    }
  }
}
</script>
