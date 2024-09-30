export class pageController {
    constructor() {
        editor: {}
    }

    static home() {
        console.log("홈");
    }

    static devlog = {
        main: () => {
            
        },

        write: () => {
            const Editor = toastui.Editor;

            const editor = new Editor({
                el: document.querySelector("#editor"),
                height: "500px",
                initialEditType: "markdown",
                previewStyle: "vertical",
                initialValue: "",
                hooks: {
                    addImageBlobHook: async (blob, callback) => {
                        const formData = new FormData();
                        formData.append("blogImgFile", blob); // 서버에서 받을 이름과 맞춤
            
                        try {
                            const response = await fetch("/src/components/common/component_upload.php", {
                                method: "POST",
                                body: formData
                            });
                            const result = await response.json();
            
                            if (result.success) {
                                // 업로드 성공 시 이미지 URL을 에디터에 삽입
                                callback(result.imageUrl, "Image");
                            } else {
                                alert(result.message);
                            }
                        } catch (error) {
                            console.error("Error uploading image:", error);
                        }
                    }
                }
            });

            this.editor = editor
        },

        modify: (value) => {
            const Editor = toastui.Editor;

            const editor = new Editor({
                el: document.querySelector("#editor"),
                height: "500px",
                initialEditType: "markdown",
                previewStyle: "vertical",
                initialValue: value,
                hooks: {
                    addImageBlobHook: async (blob, callback) => {
                        const formData = new FormData();
                        formData.append("imgFile", blob); // 서버에서 받을 이름과 맞춤
            
                        try {
                            const response = await fetch("/src/components/common/component_upload.php", {
                                method: "POST",
                                body: formData
                            });
                            const result = await response.json();
            
                            if (result.success) {
                                console.log("이미지 : ",result);
                                // 업로드 성공 시 이미지 URL을 에디터에 삽입
                                callback(result.imageUrl, "Image");
                            } else {
                                alert(result.message);
                            }
                        } catch (error) {
                            console.error("Error uploading image:", error);
                        }
                    }
                }
            });

            this.editor = editor
        },

        remove: () => {

        },
    }

    static login() {
        console.log("로그인");
    }

    // 공통
    static common = {
        sendFormContents: () => {
            document.querySelector("#form").addEventListener("submit", (event) => {
                event.preventDefault();

                const content = this.editor.getMarkdown(); // Get markdown or use getHtml() for HTML content
                document.querySelector("#postContents").value = content.replace(/<br\s*\/?>/gi, '\n'); // Sync content to textarea

                console.log("content", content.replace(/<br\s*\/?>/gi, '\n'));

                // 폼 제출
                event.target.submit(); // 이제 폼을 제출합니다.
            })
        }
    }
}