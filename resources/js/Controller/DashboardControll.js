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