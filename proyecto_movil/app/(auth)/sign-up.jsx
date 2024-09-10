import { useState } from "react";
import { Link, router } from "expo-router";
import { SafeAreaView } from "react-native-safe-area-context";
import { View, Text, ScrollView, Dimensions, Alert, Image, StyleSheet } from "react-native";
import { Video } from 'expo-av';  // Importamos el componente Video

import { images } from "../../constants";
import { createUser } from "../../lib/appwrite";
import { CustomButton, FormField } from "../../components";
import { useGlobalContext } from "../../context/GlobalProvider";

const SignUp = () => {
  const { setUser, setIsLogged } = useGlobalContext();

  const [isSubmitting, setSubmitting] = useState(false);
  const [form, setForm] = useState({
    username: "",
    email: "",
    password: "",
  });

  const submit = async () => {
    if (form.username === "" || form.email === "" || form.password === "") {
      Alert.alert("Error", "Please fill in all fields");
      return;
    }

    setSubmitting(true);
    try {
      const result = await createUser(form.email, form.password, form.username);
      setUser(result);
      setIsLogged(true);

      router.replace("/home");
    } catch (error) {
      Alert.alert("Error", error.message);
    } finally {
      setSubmitting(false);
    }
  };

  return (
    <SafeAreaView style={styles.container}>
      {/* Video de fondo */}
      <Video
        source={require('../../assets/videos/background.mp4')}  // Cambia esta línea por la ruta correcta de tu video
        style={styles.backgroundVideo}
        shouldPlay
        isLooping
        resizeMode="cover"
      />

      <View style={styles.overlay}>
        <ScrollView contentContainerStyle={styles.scrollViewContainer}>
          <View style={styles.formContainer}>
            <Image
              source={images.logo}
              resizeMode="contain"
              style={styles.logo}
            />

            <Text style={styles.title}>
              Ingresar
            </Text>

            <FormField
              title="Nombre de usuario"
              value={form.username}
              handleChangeText={(e) => setForm({ ...form, username: e })}
              otherStyles={{ marginTop: 20 }}
              containerStyles={styles.inputContainer}
              inputStyles={styles.input}
            />

            <FormField
              title="Email"
              value={form.email}
              handleChangeText={(e) => setForm({ ...form, email: e })}
              otherStyles={{ marginTop: 20 }}
              keyboardType="email-address"
              containerStyles={styles.inputContainer}
              inputStyles={styles.input}
            />

            <FormField
              title="Contraseña"
              value={form.password}
              handleChangeText={(e) => setForm({ ...form, password: e })}
              otherStyles={{ marginTop: 20 }}
              containerStyles={styles.inputContainer}
              inputStyles={styles.input}
            />

            <CustomButton
              title="Sign Up"
              handlePress={submit}
              containerStyles={styles.button}
              textStyles={styles.buttonText}
              isLoading={isSubmitting}
            />

            <View style={styles.signupContainer}>
              <Text style={styles.signupText}>
                Have an account already?
              </Text>
              <Link
                href="/sign-in"
                style={styles.signupLink}
              >
                Login
              </Link>
            </View>
          </View>
        </ScrollView>
      </View>
    </SafeAreaView>
  );
};

const styles = StyleSheet.create({
  container: {
    flex: 1,
  },
  backgroundVideo: {
    ...StyleSheet.absoluteFillObject,
    height: Dimensions.get("window").height,
    width: Dimensions.get("window").width,
  },
  overlay: {
    ...StyleSheet.absoluteFillObject,
    backgroundColor: 'rgba(0, 0, 0, 0.7)', // Fondo negro semitranslúcido para mejor visibilidad del contenido
    justifyContent: 'center',
    alignItems: 'center',
    padding: 30,
  },
  scrollViewContainer: {
    flexGrow: 1,
    justifyContent: 'center',
    alignItems: 'center',
  },
  formContainer: {
    width: '130%',
    maxWidth: 800,  // Ancho máximo aumentado para el formulario
    backgroundColor: 'rgba(0, 0, 0, 0.8)',  // Fondo negro semitranslúcido
    borderRadius: 30,  // Bordes redondeados
    padding: 100,  // Padding aumentado para mayor tamaño
    shadowColor: '#000',
    shadowOffset: { width: 0, height: 15 },
    shadowOpacity: 0.4,
    shadowRadius: 20,
    elevation: 15,
  },
  logo: {
    width: 200,
    height: 70,
    alignSelf: 'center',
  },
  title: {
    fontSize: 36,
    fontWeight: '700',
    color: '#FFFFFF',
    textAlign: 'center',
    marginVertical: 30,
  },
  inputContainer: {
    backgroundColor: '#333333',
    borderColor: '#FFFFFF',
    borderWidth: 1,
    borderRadius: 20,
    padding: 20,
  },
  input: {
    color: '#FFFFFF',
    fontSize: 20,
  },
  button: {
    marginTop: 30,
    backgroundColor: '#00796B',
    borderRadius: 20,
    paddingVertical: 20,
  },
  buttonText: {
    color: '#FFFFFF',
    fontSize: 20,
  },
  signupContainer: {
    flexDirection: 'row',
    justifyContent: 'center',
    marginTop: 40,
  },
  signupText: {
    fontSize: 20,
    color: '#FFFFFF',
  },
  signupLink: {
    fontSize: 20,
    fontWeight: '700',
    color: '#00BFFF',
    marginLeft: 5,
  },
});

export default SignUp;
