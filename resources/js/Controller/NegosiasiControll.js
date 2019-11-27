const onurl = 'https://pasangbaliho.com'

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


export async function loadNegosiasiHarga () {
    let data = 0;
    try {
        let res = await axios.get(onurl+'/adminapi/negosiasi/nego');
        data = res.data;
    } catch (error) {
        alert(error)
    }
    return data;
}

export async function loadNegosiasiHargaById (id) {
    let data = 0;
    try {
        let res = await axios.get(onurl+'/adminapi/negosiasi/negoById?id='+id);
        data = res.data;
    } catch (error) {
        alert(error)
    }
    return data;
}

export async function setHargaDeal (dataUpdate) {
    let data = 0;
    try {
        let res = await axios.post(onurl+'/adminapi/negosiasi/postPriceDeal', dataUpdate);
        data = res.data;
    } catch (error) {
        alert(error)
    }
    return data;
}

export async function loadNegosiasiMateri () {
    let data = 0;
    try {
        let res = await axios.get(onurl+'/adminapi/negosiasi/negomateri');
        data = res.data;
    } catch (error) {
        alert(error)
    }
    return data;
}

export async function loadNegosiasiMateriById (id) {
    let data = 0;
    try {
        let res = await axios.get(onurl+'/adminapi/negosiasi/negomateriById?id='+id);
        data = res.data;
    } catch (error) {
        alert(error)
    }
    return data;
}

export async function setFinishNego (dataUpdate) {
    let data = 0;
    try {
        let res = await axios.post(onurl+'/adminapi/negosiasi/finishnego', dataUpdate);
        data = res.data;
    } catch (error) {
        alert(error)
    }
    return data;
}

export async function loadMediaOnUsed (id) {
    let data = 0;
    try {
        let res = await axios.get(onurl+'/adminapi/negosiasi/mediausedon?id='+id);
        data = res.data;
    } catch (error) {
        alert(error)
    }
    return data;
}