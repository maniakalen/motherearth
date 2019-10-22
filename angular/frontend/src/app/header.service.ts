import { Injectable } from '@angular/core';
import {MenuItem} from "./widgets/menu/menu.component";

@Injectable({
  providedIn: 'root'
})
export class HeaderService {
  constructor() {
  }

  menu = [
    {title: 'Profile', route: '/user/profile'},
    {title: 'Logout', route: '/user/logout'}
    ];
}
