import puppeteer from 'puppeteer'
import fs from "fs/promises"
import promptSync from 'prompt-sync';

const url = 'https://www.siass.unam.mx/'
const path_output = '../../database/seeders/escuelas.json'


async function getCarrerasDGAE(){
    // abre el navegador
    const browser = await puppeteer.launch({
        // colocar en false si se quiere ver la ejecución del navegador
        headless: 'new',
    })
    // abre una nueva pagina
    const page =  await browser.newPage()
    // redirecciona a la pagina
    await page.goto(url)

    // Selecciona la opcion de carreras de la UNAM (sistema al que pertenence)
    await page.select('#combo_sistem_pertenece', 'dgae')

    // Ejecuta instrucciones js dentro de la pagina (como si fuera la consola)
    const result = await page.evaluate(() => {

        // selecciona el selector de las facultades y escuelas
        let options = document.querySelectorAll('#combo_facultades option')

        // filtra quitando la opcion de seleccionar, quita facultad de ingenieria y las escuelas repetidas
        options = Array.from(options).filter(op => op.value !== "0" && op.innerText !== 'FACULTAD DE INGENIERIA').map(op => op.innerText)
        return options.reduce(function (acc, curr) {
            if (!acc.includes(curr))
                acc.push(curr);
            return acc;
        }, []);
    })

    // muestra las escuelas
    // result.forEach(op => console.log(op))

    // guarda las escuelas
    await fs.writeFile(path_output, JSON.stringify(result, null, 2))

    // cierra el navegador
    await browser.close()
}

const prompt = promptSync()
const isSeguro = prompt("¿Desea obtener las carreras? [SI/NO]: ")
isSeguro === "SI" ? getCarrerasDGAE() : console.log("Abortando...")
