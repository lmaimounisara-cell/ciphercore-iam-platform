package com.ciphercore.api;

import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RestController;

@RestController
public class TestController {

    @GetMapping("/api/protected")
    public String protectedResource() {
        return "Access granted to protected CipherCore resource";
    }
}
