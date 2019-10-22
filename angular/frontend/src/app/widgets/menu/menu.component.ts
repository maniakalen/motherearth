import {Component, Input, OnInit} from '@angular/core';

export interface MenuItem {
  title: string;
  route: string;
  styleLiClass?: string;
  styleAClass?: string;
}

@Component({
  selector: 'app-widgets-menu',
  templateUrl: './menu.component.html',
  styleUrls: ['./menu.component.less']
})
export class MenuComponent implements OnInit {
  @Input() styleClass: string;
  @Input() items: MenuItem[];
  constructor() { }

  ngOnInit() {
  }

}
