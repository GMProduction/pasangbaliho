const offurl = 'http://localhost:8000';
const onurl = 'http://genossys.site'

export async function loadPermintaan () {
    let data = 0;
    try {
        let res = await axios.get(onurl+'/adminapi/negosiasi/request');
        data = res.data;
    } catch (error) {
        alert(error)
    }
    return data;
}

export async function loadPermintaanHargaById (id) {
    let data = 0;
    try {
        let res = await axios.get(onurl+'/adminapi/negosiasi/requestById?id='+id);
        data = res.data;
    } catch (error) {
        alert(error)
    }
    return data;
}

export async function setHarga (dataUpdate) {
    let data = 0;

    try {
        let res = await axios.post(onurl+'/adminapi/negosiasi/postPrice', dataUpdate);
        data = res.data;
    } catch (error) {
        alert(error)
    }
    return data;
}