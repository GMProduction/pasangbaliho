import {
    FETCH_MEDIA_IKLAN,
    FETCH_MEDIA_IKLAN_BY_ID,
    FETCH_KATEGORI,
    FETCH_PROVINSI,
    FETCH_KOTA,
    PREPARE_MOUNT,
    ON_MOUNTED,
    PAGE_PROGRESS,
    PREPARE_SEARCH,
    ON_SEARCHED,
    ON_CHANGE,
    PREPARE_SUBMIT,
    ON_SUBMITED,
    PAGE_REDIRECT,
    FETCH_MITRA,
} from '../Actions/type';


import {fetchAPI, postAPI} from '../Controller/APIControll';

export const prepareMount = () => {
    return (dispatch) => {
        dispatch({type: PREPARE_MOUNT, status: 'Mohon Tunggu Sebentar'})
        dispatch({type: PAGE_PROGRESS, progress: 30, status: 'Fetching Data...'})
    }
}

export const onMounted = () => {
    return (dispatch) => {
        dispatch({type: ON_MOUNTED, title: 'Media Iklan'})
    }
}

export const onUnMounted = () => {
    return (dispatch) => {
        dispatch({type: PAGE_REDIRECT, redirect: false})
    }
}

export const prepareSearch = () => {
    return async (dispatch) => {
        await dispatch({type: PREPARE_SEARCH})   
    }
}

export const onSearched = () => {
    return async (dispatch) => {
        await dispatch({type: ON_SEARCHED})
    }
}

export const prepareSubmit = () => {
    return async (dispatch) => {
        dispatch({type: PREPARE_SUBMIT, status: 'Proses Penymipanan Data..'})
    }
}
export const onSubmit = () => {
    return async (dispatch) => {
        dispatch({type: ON_SUBMITED})
    }
}

export const postMedia = (data, filter) => {
    return async (dispatch) => {
        const config = {
            headers: {
                'content-type': 'multipart/form-data'
            }
          }
          let url = '/mediaiklan/addmedia';
          if (filter === 'update') {
            url = '/mediaiklan/konfirmmedia';
          }
        let res = await postAPI(url, data, config);
        if (res.status === 'success') {
            if (res.data.data.status === 'ok') {
                dispatch({type: PAGE_REDIRECT, redirect: true})
                console.log(res.data.data);
            }else{
                dispatch({type: PAGE_REDIRECT, redirect: false})
                console.log(res.data);
            }
        }
        console.log(data);
        
    }
}

export const fetchMedia = (status, index) => {
    return async (dispatch) => {
        let stat = ''
        if (status !== 'all') {
            stat = status
        }
        let resMedia = await fetchAPI('/mediaiklan/request?status='+stat+'&index='+index);
        if (resMedia.status === 'success') {
           dispatch({type: FETCH_MEDIA_IKLAN, data: resMedia.data.data})
        }
    }
}

export const fetchMediaByID = (status, id) => {
    return async (dispatch) => {
        let stat = ''
        if (status !== 'all') {
            stat = status
        }
        let resKategori = await fetchAPI('/kategori/request')
        let resProvinsi = await fetchAPI('/lokasi/requestProvinsi')
        let resMedia = await fetchAPI('/mediaiklan/requestById?status='+stat+'&id='+id)
        if (resKategori.status === 'success') {
            await dispatch({type: FETCH_KATEGORI, data: resKategori.data.data})
        }
        if (resProvinsi.status === 'success') {
            await dispatch({type: FETCH_PROVINSI, data: resProvinsi.data.data})
        }

        if (resMedia.status === 'success') {
            if (resMedia.data.data !== '') {
                await dispatch({type: FETCH_MEDIA_IKLAN_BY_ID, data: resMedia.data.data, dataFound: true})
                let idProvinsi = resMedia.data.data.id_provinsi;
                let resKota = await fetchAPI('/lokasi/requestKota?id='+idProvinsi) 
                if (resKota.status === 'success') {
                    await dispatch({type: FETCH_KOTA, data: resKota.data.data})
                }
            }else {
                await dispatch({type: FETCH_MEDIA_IKLAN_BY_ID, data: null, dataFound: false})
            }
        }

        
    }
}

export const fetchKategori = () => {
    return async (dispatch) => {
        let resKategori = await fetchAPI('/kategori/request')
        if (resKategori.status === 'success') {
            await dispatch({type: FETCH_KATEGORI, data: resKategori.data.data})
        }
    }
}

export const fetchProvinsi = () => {
    return async (dispatch) => {
        let resProvinsi = await fetchAPI('/lokasi/requestProvinsi')
        if (resProvinsi.status === 'success') {
            await dispatch({type: FETCH_PROVINSI, data: resProvinsi.data.data})
        }
    }
}

export const fetchKota = (id) => {
    return async (dispatch) => {
        let resKota = await fetchAPI('/lokasi/requestKota?id='+id)
        if (resKota.status === 'success') {
            await dispatch({type: FETCH_KOTA, data: resKota.data.data})
        }
    }
}

export const fetchMitra = () => {
    return async (dispatch) => {
        let resMitra = await fetchAPI('/mitra/request')
        if (resMitra.status === 'success') {
            await dispatch({type: FETCH_MITRA, data: resMitra.data.data})
        }
    }
}
export const formValue = (name, value) => {
    return (dispatch) => {
        dispatch({type: ON_CHANGE, name: name, value: value})
    }
}

export const formMediaValue = (data) => {
    return (dispatch) => {
        if (Object.keys(data).length > 0) {
            dispatch({type: ON_CHANGE, name: 'idBaliho', value: data.id_baliho})
            dispatch({type: ON_CHANGE, name: 'idClient', value: data.id_client})
            dispatch({type: ON_CHANGE, name: 'idKategori', value: data.id_kategori})
            dispatch({type: ON_CHANGE, name: 'namaMedia', value: data.nama_baliho})
            dispatch({type: ON_CHANGE, name: 'lebar', value: data.lebar})
            dispatch({type: ON_CHANGE, name: 'tinggi', value: data.tinggi})
            dispatch({type: ON_CHANGE, name: 'luas', value: data.luas})
            dispatch({type: ON_CHANGE, name: 'idProvinsi', value: data.id_provinsi})
            dispatch({type: ON_CHANGE, name: 'idKota', value: data.id_kota})
            dispatch({type: ON_CHANGE, name: 'venue', value: data.venue})
            dispatch({type: ON_CHANGE, name: 'alamat', value: data.alamat})
            dispatch({type: ON_CHANGE, name: 'latitude', value: data.latitude})
            dispatch({type: ON_CHANGE, name: 'longitude', value: data.longitude})
            dispatch({type: ON_CHANGE, name: 'hargaClient', value: data.harga_client})
            dispatch({type: ON_CHANGE, name: 'hargaMarket', value: data.harga_market})
            dispatch({type: ON_CHANGE, name: 'orientasi', value: data.orientasi})
            dispatch({type: ON_CHANGE, name: 'deskripsi', value: data.deskripsi})
            dispatch({type: ON_CHANGE, name: 'url360', value: data.url_360})
            dispatch({type: ON_CHANGE, name: 'status', value: data.status})
        }
    }
}
