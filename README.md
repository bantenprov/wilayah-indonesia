# wilayah-indonesia
Daftar nama Provinsi, Kabupaten, Kota, Kecamat dan desa yang ada di Indonesia

## Dependency Package
This package is made for Tanara Dashboard, it needs other package:
https://github.com/laravolt/indonesia
You need to install wilayah-indonesia first then the dependency package.

## Installing Wilayah Indonesia to Tanara
Install Wilayah Indonesia Package:
```
composer require bantenprov/wilayah-indonesia:dev-master
```


## Installing Dependency Package (Laravolt\Indonesia\)
Add this line of code to:
```
'providers' => [

    Laravolt\Indonesia\ServiceProvider::class,

]
```

```
'aliases' => [

    'Indonesia' => Laravolt\Indonesia\Facade::class,

]
```
Publish dependency package with this command:
```
php artisan vendor:publish --provider="Laravolt\Indonesia\ServiceProvider"
```
Run your migrate:
```
php artisan migrate
```
Fill table with seed:
```
php artisan laravolt:indonesia:seed
```

## Since now we configure this package.

Add this line of code to config/app.php:
```
'providers' => [
		Bantenprov\WilayahIndonesia\WilayahIndonesiaServiceProvider::class,
]
```
Type this command to publish components:
```
php artisan vendor:publish --tag=wilayah-indonesia-assets
```
To update please use:
```
php artisan vendor:publish --tag=wilayah-indonesia-assets --force
```
Add this line of codes to components.js:
=======

```
//COMPONEN WILAYAH INDONESIA//
// PROVINSI //
import ProvinsiTable from './components/views/bantenprov/wilayah-indonesia/provinsi/ProvinsiTable.vue';
Vue.component('ProvinsiTable', ProvinsiTable);

// PROVINSI SEARCH//
import ProvinsiSearchTable from './components/views/bantenprov/wilayah-indonesia/provinsisearch/ProvinsiSearchTable.vue';
Vue.component('ProvinsiSearchTable', ProvinsiSearchTable);

// KABUPATEN //
import KabupatenTable from './components/views/bantenprov/wilayah-indonesia/kabupaten/KabupatenTable.vue';
Vue.component('KabupatenTable', KabupatenTable);

// KABUPATEN SEARCH//
import KabupatenSearchTable from './components/views/bantenprov/wilayah-indonesia/kabupatensearch/KabupatenSearchTable.vue';
Vue.component('KabupatenSearchTable', KabupatenSearchTable);

// KECAMATAN //
import KecamatanTable from './components/views/bantenprov/wilayah-indonesia/kecamatan/KecamatanTable.vue';
Vue.component('KecamatanTable', KecamatanTable);

// KECAMATAN SEARCH//
import KecamatanSearchTable from './components/views/bantenprov/wilayah-indonesia/kecamatansearch/KecamatanSearchTable.vue';
Vue.component('KecamatanSearchTable', KecamatanSearchTable);

// DESA //
import DesaTable from './components/views/bantenprov/wilayah-indonesia/desa/DesaTable.vue';
Vue.component('DesaTable', DesaTable);

```
Add this line of codes to routes.js:
```
  //ROUTE PROVINSI WILAYAH INDONESIA
	{
		path: '/wilayah-indonesia/provinsi',
		redirect: '/wilayah-indonesia/provinsi',
		component: layout('Default'),
		children: [
			{
				path: '/wilayah-indonesia/provinsi',
				components: {
					main: resolve => require(['./components/views/bantenprov/wilayah-indonesia/provinsi/Provinsi.vue'], resolve),
					navbar: resolve => require(['./components/Navbar.vue'], resolve),
					sidebar: resolve => require(['./components/Sidebar.vue'], resolve)
				},
				meta: {
					title: "Data Provinsi"
				}
			},
			{
				path: '/wilayah-indonesia/kabupaten',
				components: {
					main: resolve => require(['./components/views/bantenprov/wilayah-indonesia/kabupaten/Kabupaten.vue'], resolve),
					navbar: resolve => require(['./components/Navbar.vue'], resolve),
					sidebar: resolve => require(['./components/Sidebar.vue'], resolve)
				},
				meta: {
					title: "Data Kabupaten"
				}
			},
			{
				path: '/wilayah-indonesia/kabupaten/form',
				components: {
					main: resolve => require(['./components/views/bantenprov/wilayah-indonesia/kabupaten/KabupatenForm.vue'], resolve),
					navbar: resolve => require(['./components/Navbar.vue'], resolve),
					sidebar: resolve => require(['./components/Sidebar.vue'], resolve)
				},
				meta: {
					title: "Data Kabupaten"
				}
			},
			{
				path: '/wilayah-indonesia/kabupaten/:id/form',
				components: {
					main: resolve => require(['./components/views/bantenprov/wilayah-indonesia/kabupaten/KabupatenForm.vue'], resolve),
					navbar: resolve => require(['./components/Navbar.vue'], resolve),
					sidebar: resolve => require(['./components/Sidebar.vue'], resolve)
				},
				meta: {
					title: "Data Provinsi"
				}
			},
			{
				path: '/wilayah-indonesia/kecamatan',
				components: {
					main: resolve => require(['./components/views/bantenprov/wilayah-indonesia/kecamatan/Kecamatan.vue'], resolve),
					navbar: resolve => require(['./components/Navbar.vue'], resolve),
					sidebar: resolve => require(['./components/Sidebar.vue'], resolve)
				},
				meta: {
					title: "Data Kecamatan"
				}
			},
			{
				path: '/wilayah-indonesia/desa',
				components: {
					main: resolve => require(['./components/views/bantenprov/wilayah-indonesia/desa/Desa.vue'], resolve),
					navbar: resolve => require(['./components/Navbar.vue'], resolve),
					sidebar: resolve => require(['./components/Sidebar.vue'], resolve)
				},
				meta: {
					title: "Data Desa"
				}
			},
			{
				path: '/wilayah-indonesia/provinsi/form',
				components: {
					main: resolve => require(['./components/views/bantenprov/wilayah-indonesia/provinsi/ProvinsiForm.vue'], resolve),
					navbar: resolve => require(['./components/Navbar.vue'], resolve),
					sidebar: resolve => require(['./components/Sidebar.vue'], resolve)
				},
				meta: {
					title: "Data Provinsi"
				}
			},
			{
				path: '/wilayah-indonesia/provinsi/:id/form',
				components: {
					main: resolve => require(['./components/views/bantenprov/wilayah-indonesia/provinsi/ProvinsiForm.vue'], resolve),
					navbar: resolve => require(['./components/Navbar.vue'], resolve),
					sidebar: resolve => require(['./components/Sidebar.vue'], resolve)
				},
				meta: {
					title: "Data Provinsi"
				}
			},
			{
				path: '/wilayah-indonesia/:provinsi',
				components: {
					main: resolve => require(['./components/views/bantenprov/wilayah-indonesia/provinsisearch/ProvinsiSearch.vue'], resolve),
					navbar: resolve => require(['./components/Navbar.vue'], resolve),
					sidebar: resolve => require(['./components/Sidebar.vue'], resolve)
				},
				meta: {
					title: "Data Provinsi"
				}
			},
			{
				path: '/wilayah-indonesia/:provinsi/:kabupaten',
				components: {
					main: resolve => require(['./components/views/bantenprov/wilayah-indonesia/kabupatensearch/KabupatenSearch.vue'], resolve),
					navbar: resolve => require(['./components/Navbar.vue'], resolve),
					sidebar: resolve => require(['./components/Sidebar.vue'], resolve)
				},
				meta: {
					title: "Data Provinsi"
				}
			},
			{
				path: '/wilayah-indonesia/:provinsi/:kabupaten/:kecamatan',
				components: {
					main: resolve => require(['./components/views/bantenprov/wilayah-indonesia/kecamatansearch/KecamatanSearch.vue'], resolve),
					navbar: resolve => require(['./components/Navbar.vue'], resolve),
					sidebar: resolve => require(['./components/Sidebar.vue'], resolve)
				},
				meta: {
					title: "Data Provinsi"
				}
			},
		]
	},
	//END ROUTE PROVINSI WILAYAH INDONESIA	
```

Add this line of codes to menu.js:
```
  {
    name: 'Wilayah Indonesia',
    icon: 'fa fa-play-circle',
    childType: 'collapse',
    childItem: [
		{
			name: 'Provinsi',
			link: '/wilayah-indonesia/provinsi',
			icon: 'fa fa-angle-right'
		},
		{
			name: 'Kabupaten',
			link: '/wilayah-indonesia/kabupaten',
			icon: 'fa fa-angle-right'
		},
		{
			name: 'Kecamatan',
			link: '/wilayah-indonesia/kecamatan',
			icon: 'fa fa-angle-right'
		},
		{
			name: 'Desa',
			link: '/wilayah-indonesia/desa',
			icon: 'fa fa-angle-right'
		},
	]
  },

```

> You should see menu Wilayah Indonesia on left side :)