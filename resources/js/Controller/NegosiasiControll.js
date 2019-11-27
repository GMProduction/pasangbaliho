const offurl = 'http://localhost:8000';
const onurl = 'http://genossys.site'

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


export async function loadNegosiasiHarga () {
    let data = 0;
    try {
        let res = await axios.get(offurl+'/adminapi/negosiasi/nego');
        data = res.data;
    } catch (error) {
        alert(error)
    }
    return data;
}

export async function loadNegosiasiHargaById (id) {
    let data = 0;
    try {
        let res = await axios.get(offurl+'/adminapi/negosiasi/negoById?id='+id);
        data = res.data;
    } catch (error) {
        alert(error)
    }
    return data;
}

export async function setHargaDeal (dataUpdate) {
    let data = 0;
    try {
        let res = await axios.post(offurl+'/adminapi/negosiasi/postPriceDeal', dataUpdate);
        data = res.data;
    } catch (error) {
        alert(error)
    }
    return data;
}

export async function loadNegosiasiMateri () {
    let data = 0;
    try {
        let res = await axios.get(offurl+'/adminapi/negosiasi/negomateri');
        data = res.data;
    } catch (error) {
        alert(error)
    }
    return data;
}

export async function loadNegosiasiMateriById (id) {
    let data = 0;
    try {
        let res = await axios.get(offurl+'/adminapi/negosiasi/negomateriById?id='+id);
        data = res.data;
    } catch (error) {
        alert(error)
    }
    return data;
}

export async function setFinishNego (dataUpdate) {
    let data = 0;
    try {
        let res = await axios.post(offurl+'/adminapi/negosiasi/finishnego', dataUpdate);
        data = res.data;
    } catch (error) {
        alert(error)
    }
    return data;
}

export async function loadMediaOnUsed (id) {
    let data = 0;
    try {
        let res = await axios.get(offurl+'/adminapi/negosiasi/mediausedon?id='+id);
        data = res.data;
    } catch (error) {
        alert(error)
    }
    return data;
}