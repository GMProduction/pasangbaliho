const onurl = 'http://localhost:8000'

export async function loadPermintaan () {
    let data = 0;
    try {
        let res = await axios.get(onurl+'/adminapi/mediaiklan/request');
        data = res.data;
    } catch (error) {
        alert(error)
    }
    return data;
}

export async function loadMediaPublish () {
    let data = 0;
    try {
        let res = await axios.get(onurl+'/adminapi/mediaiklan/requestpublish');
        data = res.data;
    } catch (error) {
        alert(error)
    }
    return data;
}
export async function loadMediaBlock () {
    let data = 0;
    try {
        let res = await axios.get(onurl+'/adminapi/mediaiklan/requestblock');
        data = res.data;
    } catch (error) {
        alert(error)
    }
    return data;
}
export async function loadAllMedia () {
    let data = 0;
    try {
        let res = await axios.get(onurl+'/adminapi/mediaiklan/requestAllMedia');
        data = res.data;
    } catch (error) {
        alert(error)
    }
    return data;
}

export async function loadPermintaanMediaById (id) {
    let data = 0;
    try {
        let res = await axios.get(onurl+'/adminapi/mediaiklan/requestById?id='+id);
        data = res.data;
    } catch (error) {
        alert(error)
    }
    return data;
}

export async function KonfirmasiMedia (dataUpdate) {
    let data = 0;
    const config = {
        headers: {
            'content-type': 'multipart/form-data'
        }
      }
    try {
        let res = await axios.post(onurl+'/adminapi/mediaiklan/konfirmmedia', dataUpdate, config);
        data = res;
    } catch (error) {
        alert(error)
    }
    return data;
}
export async function addMedia (dataUpdate) {
    let data = 0;
    const config = {
        headers: {
            'content-type': 'multipart/form-data'
        }
      }
    try {
        let res = await axios.post(onurl+'/adminapi/mediaiklan/addmedia', dataUpdate, config);
        data = res;
    } catch (error) {
        alert(error)
    }
    return data;
}