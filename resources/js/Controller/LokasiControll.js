const onurl = 'https://pasangbaliho.com';

export async function loadProvinsi () {
    let data = 0;
    try {
        let res = await axios.get(onurl+'/adminapi/lokasi/requestProvinsi');
        data = res.data;
    } catch (error) {
        alert(error)
    }
    return data;
}
export async function loadKota (idprovinsi) {
    let data = 0;
    try {
        let res = await axios.get(onurl+'/adminapi/lokasi/requestKota?id='+idprovinsi);
        data = res.data;
    } catch (error) {
        alert(error)
    }
    return data;
}