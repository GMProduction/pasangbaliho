import {
    PREPARE_MOUNT,
    ON_MOUNTED,
    FETCH_PERMINTAAN_HARGA,
    FETCH_QTY_BALIHO,
    FETCH_QTY_MITRA,
    FETCH_QTY_ADVERTISER,
    FETCH_MEDIA_IKLAN
} from './type';
import {dashboardAPI} from '../Controller/DashboardControll';


export const initData = () => {
    return async (dispatch) => {
        await dispatch({type: PREPARE_MOUNT});
        let resQtyBaliho = await dashboardAPI('/adminapi/mediaiklan/countMedia')   
        if (resQtyBaliho.statusdata === 'success') {
            await dispatch({type: FETCH_QTY_BALIHO, data: resQtyBaliho.data.data, progress: 30, status: 'Fetching Jumlah Baliho Berhasil...'})
        }

        let resQtyMitra = await dashboardAPI('/adminapi/mitra/countMitra')   
        if (resQtyMitra.statusdata === 'success') {
            await dispatch({type: FETCH_QTY_MITRA, data: resQtyMitra.data.data, progress: 40, status: 'Fetching Jumlah Mitra Berhasil...'})
        }
        let resQtyAdvertiser = await dashboardAPI('/adminapi/advertiser/countAdvertiser')
        if (resQtyAdvertiser.statusdata === 'success') {
            await dispatch({type: FETCH_QTY_ADVERTISER, data: resQtyAdvertiser.data.data, progress: 50, status: 'Fetching Jumlah Advertiser Berhasil...'})
        }

        let resPermintaanAsset = await dashboardAPI('/adminapi/mediaiklan/request?status=pending&index=')
        if (resPermintaanAsset.statusdata === 'success') {
           await dispatch({type: FETCH_MEDIA_IKLAN, data: resPermintaanAsset.data.data, progress: 70, status: 'Fetching Permintaan Penambahan Assets Berhasil...', isLoading: true})
        }
        

        let resPermintaanHarga = await dashboardAPI('/adminapi/negosiasi/request')
        if (resPermintaanHarga.statusdata === 'success') {
            await dispatch({
                type: FETCH_PERMINTAAN_HARGA, 
                data: resPermintaanHarga.data.data, 
                progress: 90, 
                status: 'Fetching Permintaan Harga Berhasil...', 
            })
        }   
        await dispatch({type: ON_MOUNTED});
    }   
}

export const resetData = () => {
    return (dispatch) => {
        dispatch({type: 'RESET'})
    }
}