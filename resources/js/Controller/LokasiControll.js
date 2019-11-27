const offurl = 'http://localhost:8000';
const onurl = 'http://genossys.site'

export async function loadProvinsi () {
    let data = 0;
    try {
        let res = await axios.get(offurl+'/adminapi/lokasi/requestProvinsi');
        data = res.data;
    } catch (error) {
        alert(error)
    }
    return data;
}
export async function loadKota (idprovinsi) {
    let data = 0;
    try {
        let res = await axios.get(offurl+'/adminapi/lokasi/requestKota?id='+idprovinsi);
        data = res.data;
    } catch (error) {
        alert(error)
    }
    return data;
}