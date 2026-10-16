package com.ciphercore.api;

import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

@RestController
@RequestMapping("/api")
public class RoleController {

    @GetMapping("/visitor/dashboard")
    public String visitorDashboard() {
        return "VISITEUR access granted: read-only dashboard.";
    }

    @GetMapping("/editor/dashboard")
    public String editorDashboard() {
        return "EDITEUR access granted: resource editing dashboard.";
    }

    @GetMapping("/admin/dashboard")
    public String adminDashboard() {
        return "ADMIN access granted: administrative dashboard.";
    }
}
