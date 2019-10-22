import { Component, OnInit } from '@angular/core';
import {HeaderService} from "../header.service";

@Component({
  selector: 'app-header',
  templateUrl: './header.component.html',
  styleUrls: ['./header.component.less']
})
export class HeaderComponent implements OnInit {

  constructor(public header: HeaderService) { }

  ngOnInit() {

  }

}
