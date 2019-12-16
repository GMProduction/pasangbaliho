import {
    PREPARE_MOUNT,
    ON_MOUNTED,
    PAGE_PROGRESS,
    FETCH_QTY_MEDIA,
    FETCH_PERMINTAAN_HARGA,
    FETCH_QTY_MITRA,
    FETCH_QTY_ADVERTISER,
    FETCH_MEDIA_IKLAN,
} from './type';

import {fetchAPI} from '../Controller/APIControll';

export const prepareMount = () => {
    return (dispatch) => {
        dispatch({type: PREPARE_MOUNT, status: 'Mohon Tunggu Sebentar'})
    }
}

export const onMounted = () => {
    return (dispatch) => {
        dispatch({type: ON_MOUNTED, title: 'Dashboard'})
    }
}

export const fetchData = () => {
    return async (dispatch) => {
        await dispatch({type: PAGE_PROGRESS, progress: 30, status: 'Fetching Data...'})
        let resCountMedia = await fetchAPI('/mediaiklan/countMedia')   
        if (resCountMedia.status === 'success') {
            await dispatch({type: FETCH_QTY_MEDIA, data: resCountMedia.data.data});
        }

        let resCountMitra = await fetchAPI('/mitra/cMitra')   
        if (resCountMitra.status === 'success') {
            await dispatch({type: FETCH_QTY_MITRA, data: resCountMitra.data.data})
        }

        let resCountAdvertiser = await fetchAPI('/advertiser/cAdvertiser')
        if (resCountAdvertiser.status === 'success') {
            await dispatch({type: FETCH_QTY_ADVERTISER, data: resCountAdvertiser.data.data})
        }

        let resPermintaanAsset = await fetchAPI('/mediaiklan/request?status=pending&index=')
        if (resPermintaanAsset.status === 'success') {
           await dispatch({type: FETCH_MEDIA_IKLAN, data: resPermintaanAsset.data.data})
        }
        

        let resPermintaanHarga = await fetchAPI('/negosiasi/request?status=permintaan&index=')
        if (resPermintaanHarga.status === 'success') {
            await dispatch({type: FETCH_PERMINTAAN_HARGA, data: resPermintaanHarga.data.data})
        }   
    }   
}
