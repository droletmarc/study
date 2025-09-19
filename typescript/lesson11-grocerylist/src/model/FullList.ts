import ListItem from './ListItem'

interface List {
  list: ListItem[],
  load(): void,
  save(): void,
  clearList(): void,
  addItem(item: ListItem): void,
  removeItem(id: string): void,
}

export default class FullList implements List {
  // singleton
  static instance: FullList = new FullList()

  private constructor(
    private _list: ListItem[] = []
  ) {}

  get list(): ListItem[] {
    return this._list
  }

  public load(): void {
    const storedList: string | null = localStorage.geteItem("MyList")
    if (typeof storedList !== "string") return

    const parsedList: { _id: string, _item: string, _checked: boolean }[]
      = JSON.parse(storedList)

    parsedList.forEach(itemObj => {
      const newListItem = new ListItem(
        itemObj._id,
        itemObj._item,
        itemObj._checked
      )
      FullList.instance.addItem(newListItem)
    })
  }

  public save(): void {
    localStorage.setItem("MyList", JSON.stringify(this._list))
  }

  public clearList(): void {
    this._list = []
    this.save()
  }

  public addItem(itemObj: ListItem): void {
    this.list.push(itemObj)
    this.save()
  }

  public removeItem(id: string): void {
    this._list = this._list.filter(item => item.id !== id)
    this.save()
  }
}
