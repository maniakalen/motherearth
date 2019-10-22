import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { UserModule } from "./user/user.module";
import { PageNotFoundComponent } from './page-not-found/page-not-found.component';
import { HttpClientModule } from '@angular/common/http';
import { MapComponent } from './map/map.component';
import { AgmCoreModule } from "@agm/core";
import { SidebarComponent } from './sidebar/sidebar.component';
import { HeaderComponent } from './header/header.component';
import { HeaderLayoutComponent } from './header-layout/header-layout.component';
import { HeadlessLayoutComponent } from './headless-layout/headless-layout.component';
import {WidgetsModule} from "./widgets/widgets.module";
import { FrontComponent } from './front/front.component';
@NgModule({
  declarations: [
    AppComponent,
    PageNotFoundComponent,
    MapComponent,
    SidebarComponent,
    HeaderComponent,
    HeaderLayoutComponent,
    HeadlessLayoutComponent,
    FrontComponent
  ],
  imports: [
    BrowserModule,
    UserModule,
    HttpClientModule,
    WidgetsModule,
    AppRoutingModule,
    AgmCoreModule.forRoot({
      apiKey: 'AIzaSyAWn9_i_HDskLOSPW7_z4QpHhmR3UyGqBk'
    })
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
