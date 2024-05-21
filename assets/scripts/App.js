import Router from "./Router.js"
import Users from "./View/Users.js"
import UserOrders from "./View/UserOrders.js"
import Products from "./View/Products.js"
import AddProduct from "./View/AddProduct.js"

const on = addEventListener, off = removeEventListener
const emit = (t, d) => dispatchEvent (new CustomEvent (t, {'detail': d}))

export default class App {

    constructor()
    {
        new Router ([
            [/^users\/*$/, this.users.bind(this)],
            [/^user\/\d+\/orders\/*$/, this.userOrders.bind(this)],
            [/^products\/*$/, this.products.bind(this)],
            [/^products\/add\/*$/, this.addProduct.bind(this)],
            [/^.*$/, this.index.bind(this)]
        ]).listen ()

        on(`submit`, this.postProduct.bind(this))
        Router.navigate(Router.hash() ?? "index")
    }

    index()
    {
        window.app.innerHTML = ``
    }

    async users()
    {
        try
        {
            const users = await this.#get(`/users/`)
            const view = new Users()

            window.app.innerHTML = view.render(users)
        }
        catch(ex)
        {
            alert(ex)
        }
    }

    async userOrders()
    {
        try
        {
            const userID = Router.hash().replace(/(user\/)|(\/orders)/g, ``)
            const userOrders = await this.#get(`/user/${userID}/orders/`)
            const view = new UserOrders()

            window.app.innerHTML = view.render(userOrders.map(order => order.product))
        }
        catch(ex)
        {
            alert(ex)
        }
    }

    async products()
    {
        try
        {
            const products = await this.#get(`/products`)
            const view = new Products()

            window.app.innerHTML = view.render(products)
        }
        catch(ex)
        {
            alert(ex)
        }
    }

    async addProduct()
    {
        const view = new AddProduct()
        window.app.innerHTML = view.render()
    }

    async postProduct(ev)
    {
        if (`product` !== ev.target.id)
        {
            return
        }

        ev.preventDefault()

        this.#post(`/products/add`, ev.target)

        Router.navigate(`products`)
    }

    async #get(url)
    {
        const response = await fetch(url)

        if (response.status !== 200)
        {
            throw new Error(response.statusText)
        }

        return await response.json()
    }

    async #post(url, data)
    {
        const method = `POST`
        const body = new FormData(data)

        const response = await fetch(url, {method, body})

        if (response.status !== 200)
        {
            throw new Error(response.statusText)
        }

        return await response.json()
    }
    
    static load()
    {
        new App()
    }
}