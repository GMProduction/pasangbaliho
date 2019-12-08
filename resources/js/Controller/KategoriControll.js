const onurl = 'http://localhost:8000';

export async function loadKategori () {
    let data = 0;
    try {
        let res = await axios.get(onurl+'/adminapi/kategori/request');
        data = res.data;
    } catch (error) {
        alert(error)
    }
    return data;
}