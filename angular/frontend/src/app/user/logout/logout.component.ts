import { Component, OnInit } from '@angular/core';
import {ApiService} from "../../api.service";
import {AuthService} from "../auth.service";
import {Router} from "@angular/router";

@Component({
  selector: 'app-logout',
  templateUrl: './logout.component.html',
  styleUrls: ['./logout.component.less']
})
export class LogoutComponent implements OnInit {

  constructor(private auth: AuthService, private router: Router) { }

  ngOnInit() {
    this.auth.logout();
    this.router.navigate(['/user/login'])
  }

}
