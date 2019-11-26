const offurl = 'http://localhost:8000';

export async function loadPermintaan () {
    let data = 0;
    try {
        let res = await axios.get(offurl+'/adminapi/negosiasi/request');
        data = res.data;
    } catch (error) {
        alert(error)
    }
    return data;
}

export async function loadPermintaanHargaById (id) {
    let data = 0;
    try {
        let res = await axios.get(offurl+'/adminapi/negosiasi/requestById?id='+id);
        data = res.data;
    } catch (error) {
        alert(error)
    }
    return data;
}

export async function setHarga (dataUpdate) {
    let data = 0;

    try {
        let res = await axios.post(offurl+'/adminapi/negosiasi/postPrice', dataUpdate);
        data = res.data;
    } catch (error) {
        alert(error)
    }
    return data;
}